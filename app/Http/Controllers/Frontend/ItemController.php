<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UploadedFiles;
use App\Traits\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    use FileUpload;

    public function index()
    {
        $categories = Category::all();
        return view('frontend.dashboard.item.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $category = Category::whereSlug($request->category)->firstOrFail();

        session()->put('selected_category', $category->id);

        $uploadFiles = $this->getAuthorFilesByCategory($category->id);

        return view('frontend.dashboard.item.create', compact('categories', 'category', 'uploadFiles'));
    }

    public function itemUploads(Request $request): JsonResponse
    {
        $sessionId = session()->get('selected_category');
        $category = Category::findOrFail($sessionId);

        $supportedExtensions = Str::lower(implode(',', $category->file_types));

        $request->validate([
            'file.*' => 'required|mimes:' . $supportedExtensions . '|max:102400',
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

        $uploadFiles = $this->getAuthorFilesByCategory($sessionId);

        return response()->json([
            'files' => $uploadFiles,
        ], 200);
    }

    private function getAuthorFilesByCategory(int $categoryId)
    {
        return UploadedFiles::where('author_id', Auth::id())
            ->where('category_id', $categoryId)
            ->get();
    }

    public function delete($id)
    {
        $file = UploadedFiles::whereId($id)
            ->where('author_id', Auth::id())
            ->first();

        if (!$file) {
            return response()->json(['status' => 'error'], 422);
        }

        $this->deleteFile($file->path, 'local');
        $file->delete();

        return response()->json(['status' => 'success', 'message' => 'Deleted Successfully'], 200);
    }
}
