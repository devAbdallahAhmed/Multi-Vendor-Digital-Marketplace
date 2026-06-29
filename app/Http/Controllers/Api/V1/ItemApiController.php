<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ItemUpdateRequest;
use App\Http\Requests\ItemStoreRequest;
use App\Repositories\ItemRepository;
use App\Services\ItemService;
use App\Models\Category;
use App\Models\UploadedFiles;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ItemApiController extends Controller
{
    protected $itemService;
    protected $itemRepository;

    // Standard Dependency Injection via Constructor
    public function __construct(ItemService $itemService, ItemRepository $itemRepository)
    {
        $this->itemService = $itemService;
        $this->itemRepository = $itemRepository;
    }

    /**
     * 1. List all items for the logged-in Author
     */
    public function index(): JsonResponse
    {
        $items = $this->itemRepository->getPaginatedAuthorItems();

        return response()->json([
            'status'  => 'success',
            'message' => 'Items retrieved successfully.',
            'data'    => $items
        ], 200); // 200 OK
    }

    /**
     * 2. Store a new item
     */
    public function store(ItemStoreRequest $request): JsonResponse
    {
        // Reusing our robust ItemService logic
        $item = $this->itemService->storeItem($request->validated(), $request->message_for_reviewer);

        return response()->json([
            'status'  => 'success',
            'message' => 'Item submitted for review successfully.',
            'data'    => $item
        ], 201); // 201 Created (The accurate code for creating resources)
    }

    /**
     * 3. Show details of a single item
     */
    public function show(int $id): JsonResponse
    {
        $item = $this->itemRepository->findAuthorItemById($id);

        return response()->json([
            'status'  => 'success',
            'data'    => $item
        ], 200);
    }

    /**
     * 4. Update an existing item
     */
    public function update(ItemUpdateRequest $request, int $id): JsonResponse
    {
        $item = $this->itemRepository->findAuthorItemById($id);

        // Business Rule: Check if the item status allows modification
        if ($item->status !== 'approved' && $item->status !== 'active' && $item->status !== 'soft_reject') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Action unauthorized. Item cannot be edited at this stage.'
            ], 403); // 403 Forbidden (Better than 404 for APIs because the resource exists but access is restricted)
        }

        $updatedItem = $this->itemService->updateItem($item, $request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Item updated successfully.',
            'data'    => $updatedItem
        ], 200);
    }

    /**
     * 5. Handle file uploads from mobile/frontend (Dropzone substitute)
     */
    public function itemUploads(Request $request): JsonResponse
    {
        // For APIs, we expect category_id in the request payload instead of checking standard Web Session
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'file.*'      => 'required|file|max:102400',
        ]);

        $categoryId = $request->category_id;
        $category = Category::findOrFail($categoryId);
        $supportedExtensions = Str::lower(implode(',', $category->file_types));

        // Extra dynamic validation layer for file extensions matching category rules
        $request->validate([
            'file.*' => "mimes:{$supportedExtensions}",
        ]);

        $uploadedRecords = [];

        foreach ($request->file('file') as $file) {
            // Using the precise Trait method inside our service layer
            $fileInfo = $this->itemService->uploadFileWithDetails($file);

            if ($fileInfo) {
                $uploadedRecords[] = UploadedFiles::create([
                    'category_id' => $categoryId,
                    'author_id'   => Auth::id(),
                    'name'        => $fileInfo['name'],
                    'extension'   => $fileInfo['extension'],
                    'mime_type'   => $fileInfo['mime_type'],
                    'path'        => $fileInfo['path'],
                    'size'        => $fileInfo['size'],
                ]);
            }
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Files uploaded successfully.',
            'data'    => $uploadedRecords
        ], 200);
    }

    /**
     * 6. Delete a temporarily uploaded file
     */
    public function deleteUpload(int $id): JsonResponse
    {
        $file = UploadedFiles::where('id', $id)
            ->where('author_id', Auth::id())
            ->first();

        if (!$file) {
            return response()->json([
                'status'  => 'error',
                'message' => 'File not found or unauthorized.'
            ], 422); // 422 Unprocessable Entity
        }

        $this->itemService->deleteFile($file->path, 'local');
        $file->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Temporary file deleted successfully.'
        ], 200);
    }

    /**
     * 7. Store a new release version (Changelog)
     */
    public function storeChangelog(Request $request, int $id): JsonResponse
    {
        $item = $this->itemRepository->findAuthorItemById($id);

        if ($item->status !== 'approved' && $item->status !== 'active') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Cannot add changelog for non-approved items.'
            ], 403);
        }

        $validated = $request->validate([
            'version'     => 'required|string|max:330',
            'description' => 'required|string|max:1000',
        ]);

        $changelog = $this->itemService->storeChangelog($item, $validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Changelog version added successfully.',
            'data'    => $changelog
        ], 201);
    }

    /**
     * 8. Get review history logs for an item
     */
    public function history(int $id): JsonResponse
    {
        $item = $this->itemRepository->findAuthorItemById($id);
        $histories = $this->itemRepository->getHistoryByItemId($id);

        return response()->json([
            'status'  => 'success',
            'data'    => [
                'item'    => $item,
                'history' => $histories
            ]
        ], 200);
    }
}
