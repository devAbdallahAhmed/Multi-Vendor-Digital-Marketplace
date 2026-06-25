<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ItemUpdateRequest;
use App\Http\Requests\ItemStoreRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\UploadedFiles;
use App\Services\NotificationService;
use App\Traits\FileUpload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    use FileUpload;

    public function index()
    {
        $categories = Category::all();
        $items = Item::with(['category', 'sub_category'])
            ->where('author_id', Auth::id())
            ->paginate(10);

        return view('frontend.dashboard.item.index', compact('categories', 'items'));
    }

    public function create(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $category = Category::whereSlug($request->category)->firstOrFail();

        session()->put('selected_category', $category->id);
        $uploadFiles = $this->getAuthorFilesByCategory($category->id);

        return view('frontend.dashboard.item.create', compact('categories', 'category', 'uploadFiles'));
    }

    public function store(ItemStoreRequest $request)
    {
        $item = new Item();
        $item->fill($request->validated());
        $item->author_id = Auth::id();
        $item->status = 'pending';

        if (in_array($request->preview_type, ['image', 'video', 'audio'])) {
            $propertyName = "preview_" . $request->preview_type;
            $item->{$propertyName} = $request->preview_file;
        }

        $item->is_main_file_external = ($request->source_type === 'upload') ? 0 : 1;
        $item->main_file = ($request->source_type === 'upload') ? $request->upload_source : $request->link_source;
        $item->save();

        $this->movePublicAsset($request->screenshots ?? [], $request->preview_file);
        NotificationService::created();

        return redirect()->route('user.items.index');
    }

    public function itemUploads(Request $request): JsonResponse
    {
        $sessionId = session()->get('selected_category');
        $category = Category::findOrFail($sessionId);
        $supportedExtensions = Str::lower(implode(',', $category->file_types));

        $request->validate([
            'file.*' => "required|mimes:{$supportedExtensions}|max:102400",
        ]);

        foreach ($request->file('file') as $file) {
            $fileInfo = $this->uploadFileWithDetails($file);

            if ($fileInfo) {
                UploadedFiles::create([
                    'category_id' => $sessionId,
                    'author_id'   => Auth::id(),
                    'name'        => $fileInfo['name'],
                    'extension'   => $fileInfo['extension'],
                    'mime_type'   => $fileInfo['mime_type'],
                    'path'        => $fileInfo['path'],
                    'size'        => $fileInfo['size'],
                ]);
            }
        }

        return $this->respondWithFileList($sessionId);
    }

    public function edit(string $id)
    {
        $item = Item::with(['category', 'sub_category'])
            ->where('id', $id)
            ->where('author_id', Auth::id())
            ->firstOrFail();

        session()->put('selected_category', $item->category->id);

        $uploadFiles = $this->getAuthorFilesByCategory($item->category->id);

        return view('frontend.dashboard.item.edit', compact('item', 'uploadFiles'));
    }

    public function update(ItemUpdateRequest $request, string $id)
    {
        $item = Item::where('id', $id)
            ->where('author_id', Auth::id())
            ->firstOrFail();

        $oldPreviewType = $item->preview_type;
        $oldPreviewFile = $item->{"preview_" . $oldPreviewType} ?? null;

        $item->fill($request->validated());

        $item->preview_image = null;
        $item->preview_video = null;
        $item->preview_audio = null;

        if (in_array($request->preview_type, ['image', 'video', 'audio'])) {
            $propertyName = "preview_" . $request->preview_type;
            $item->{$propertyName} = $request->preview_file;
        }

        // Check if source_type is provided to update the file fields safely
        if ($request->has('source_type')) {
            $item->is_main_file_external = ($request->source_type === 'upload') ? 0 : 1;
            $item->main_file = ($request->source_type === 'upload') ? $request->upload_source : $request->link_source;
        }

        if ($item->status === 'soft_reject') {
            $item->status = 'resubmitted';
        }

        $item->save();

        $this->movePublicAsset($request->screenshots ?? [], $request->preview_file);

        if ($request->preview_file && $oldPreviewFile && $request->preview_file !== $oldPreviewFile) {
            $this->deleteFile($oldPreviewFile, 'public');
        }

        NotificationService::updated(__('Item updated successfully.'));

        return redirect()->route('user.items.index');
    }

    public function delete($id): JsonResponse
    {
        $sessionId = session()->get('selected_category');
        $file = UploadedFiles::whereId($id)
            ->where('author_id', Auth::id())
            ->first();

        if (!$file) {
            return response()->json(['status' => 'error', 'message' => 'File not found'], 422);
        }

        $this->deleteFile($file->path, 'local');
        $file->delete();

        return $this->respondWithFileList($sessionId, 'success');
    }

    public function download(string $id)
    {
        $item = Item::where('id', $id)
            ->where('author_id', Auth::id())
            ->firstOrFail();

        if ($item->is_main_file_external) {
            if (filter_var($item->main_file, FILTER_VALIDATE_URL)) {
                return redirect()->away($item->main_file);
            }
            abort(404, 'External link is invalid.');
        }

        $cleanPath = ltrim($item->main_file, '/');
        $storagePath = storage_path('app/private/' . $cleanPath);

        if (!File::exists($storagePath)) {
            abort(404, 'The requested file does not exist on the server.');
        }

        $fileName = basename($storagePath);
        $mimeType = File::mimeType($storagePath);

        return response()->download($storagePath, $fileName, [
            'Content-Type' => $mimeType,
        ]);
    }


    private function getAuthorFilesByCategory(int $categoryId)
    {
        return UploadedFiles::where('author_id', Auth::id())
            ->where('category_id', $categoryId)
            ->get();
    }

    private function respondWithFileList(int $categoryId, string $status = 'success'): JsonResponse
    {
        $uploadFiles = $this->getAuthorFilesByCategory($categoryId);
        $html = view('frontend.dashboard.layouts.partials.file-list-item', compact('uploadFiles'))->render();

        return response()->json([
            'status' => $status,
            'files'  => $uploadFiles,
            'html'   => $html
        ], 200);
    }
}
