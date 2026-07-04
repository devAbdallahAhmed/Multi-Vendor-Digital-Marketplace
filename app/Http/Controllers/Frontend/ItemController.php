<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ItemUpdateRequest;
use App\Http\Requests\ItemStoreRequest;
use App\Models\Category;
use App\Services\ItemService;
use App\Repositories\ItemRepository;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    protected $itemService;
    protected $itemRepository;

    public function __construct(ItemService $itemService, ItemRepository $itemRepository)
    {
        $this->itemService = $itemService;
        $this->itemRepository = $itemRepository;
    }

    public function index()
    {
        $categories = Category::all();
        $items = $this->itemRepository->getPaginatedAuthorItems();

        return view('frontend.dashboard.item.index', compact('categories', 'items'));
    }

    public function create(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $category = Category::whereSlug($request->category)->firstOrFail();

        session()->put('selected_category', $category->id);
        $uploadFiles = $this->itemRepository->getFilesByAuthorAndCategory($category->id);

        return view('frontend.dashboard.item.create', compact('categories', 'category', 'uploadFiles'));
    }

    public function store(ItemStoreRequest $request)
    {
        $this->itemService->storeItem($request->validated(), $request->message_for_reviewer);
        NotificationService::created(__('Item created successfully.'));

        return redirect()->route('user.items.index');
    }

    public function edit(string $id)
    {
        $item = $this->itemRepository->findAuthorItemById($id);

        if ($item->status !== 'approved' && $item->status !== 'active' && $item->status !== 'soft_reject' && $item->status !== 'pending') {
            abort(404);
        }

        session()->put('selected_category', $item->category_id);
        $uploadFiles = $this->itemRepository->getFilesByAuthorAndCategory($item->category_id);

        return view('frontend.dashboard.item.edit', compact('item', 'uploadFiles'));
    }

    public function update(ItemUpdateRequest $request, string $id)
    {
        $item = $this->itemRepository->findAuthorItemById($id);

        if ($item->status !== 'approved' && $item->status !== 'active' && $item->status !== 'soft_reject') {
            abort(404);
        }

        $this->itemService->updateItem($item, $request->validated());
        NotificationService::updated(__('Item updated successfully.'));

        return redirect()->route('user.items.index');
    }

    public function download(string $id)
    {
        $item = $this->itemRepository->findAuthorItemById($id);
        $downloadData = $this->itemService->downloadFile($item);

        if ($downloadData['type'] === 'url') {
            return redirect()->away($downloadData['path']);
        }

        return response()->download($downloadData['path'], basename($downloadData['path']), [
            'Content-Type' => File::mimeType($downloadData['path']),
        ]);
    }

    public function changelog(Request $request, int $id)
    {
        $item = $this->itemRepository->findAuthorItemById($id);

        if ($item->status !== 'approved' && $item->status !== 'active') {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'version'     => 'required|string|max:330',
                'description' => 'required|string|max:1000',
            ]);

            $this->itemService->storeChangelog($item, $validated);
            NotificationService::created(__('Changelog updated successfully.'));
            return redirect()->back();
        }

        return view('frontend.dashboard.item.changelog', compact('item'));
    }

    public function history(int $id)
    {
        $item = $this->itemRepository->findAuthorItemById($id);
        $histories = $this->itemRepository->getHistoryByItemId($id);

        return view('frontend.dashboard.item.history', compact('item', 'histories'));
    }

    /**
     * Handle chunk/file uploads from Dropzone for a selected category
     */
    public function itemUploads(Request $request): \Illuminate\Http\JsonResponse
    {
        $sessionId = session()->get('selected_category');
        $category = \App\Models\Category::findOrFail($sessionId);
        $supportedExtensions = \Illuminate\Support\Str::lower(implode(',', $category->file_types));

        $request->validate([
            'file.*' => "required|mimes:{$supportedExtensions}|max:102400",
        ]);

        foreach ($request->file('file') as $file) {
            $fileInfo = $this->itemService->uploadFileWithDetails($file);

            if ($fileInfo) {
                \App\Models\UploadedFiles::create([
                    'category_id' => $sessionId,
                    'author_id'   => \Illuminate\Support\Facades\Auth::id(),
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

    /**
     * Delete a temporarily uploaded file from the list
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $sessionId = session()->get('selected_category');
        $file = \App\Models\UploadedFiles::whereId($id)
            ->where('author_id', \Illuminate\Support\Facades\Auth::id())
            ->first();

        if (!$file) {
            return response()->json(['status' => 'error', 'message' => 'File not found'], 422);
        }

        $this->itemService->deleteFile($file->path, 'local');
        $file->delete();

        return $this->respondWithFileList($sessionId, 'success');
    }

    /**
     * Helper to render and return the updated file list HTML for Dropzone
     */
    private function respondWithFileList(int $categoryId, string $status = 'success'): \Illuminate\Http\JsonResponse
    {
        $uploadFiles = $this->itemRepository->getFilesByAuthorAndCategory($categoryId);
        $html = view('frontend.dashboard.layouts.partials.file-list-item', compact('uploadFiles'))->render();

        return response()->json([
            'status' => $status,
            'files'  => $uploadFiles,
            'html'   => $html
        ], 200);
    }

  
}

