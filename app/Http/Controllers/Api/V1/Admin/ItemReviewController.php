<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\ItemSingleShowResource;
use App\Services\Admin\ItemReviewService;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Requests\Admin\ItemStatusUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Api\Admin\ItemIndexResource;
class ItemReviewController extends Controller
{
    public function __construct(protected ItemReviewService $itemReviewService) {}

    function pendingIndex()
    {
        $items = $this->itemReviewService->getItemsByStatus('pending');

        return response()->json(['success' => true, 'Message' => 'this is All Data', 'data' => $items], 200);
    }

    function pendingShow(int $id)
    {
        $item = Item::with('histories')->findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'This is Show Single Item',
            'data'    => new ItemSingleShowResource($item)
        ], 200);
    }

    public function updateStatus(ItemStatusUpdateRequest $request, int $id)
    {
        $item = Item::findOrFail($id);

        $isAdmin = Auth::guard('admin')->user()?->hasRole('super admin') ?? false;
        $isPendingOrResubmitted = in_array($item->status, ['pending', 'resubmitted']);

        if (!$isAdmin && !$isPendingOrResubmitted) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot change the status after it has been processed.',

            ], 403);
        }

        $this->itemReviewService->updateStatus(
            $item,
            $request->validated(),
            Auth::guard('admin')->id() ?? auth()->id()
        );

        return response()->json(['success' => true, 'message' => 'The Updated Status Successfully', 'data' => $item], 201);
    }

    public function approveIndex(): JsonResponse
    {
        $items = $this->itemReviewService->getItemsByStatus('active');

        return response()->json([
            'success' => true,
            'counts'  => $this->itemReviewService->getStatusCounts(),
            'items'   => ItemIndexResource::collection($items)->response()->getData(true)
        ], 200);
    }

    public function softRejectedIndex(): JsonResponse
    {
        $items = $this->itemReviewService->getRejectedItems('soft_reject');

        return response()->json([
            'success' => true,
            'counts'  => $this->itemReviewService->getStatusCounts(),
            'items'   => ItemIndexResource::collection($items)->response()->getData(true)
        ], 200);
    }

    public function hardRejectedIndex(): JsonResponse
    {
        $items = $this->itemReviewService->getRejectedItems('hard_reject');

        return response()->json([
            'success' => true,
            'counts'  => $this->itemReviewService->getStatusCounts(),
            'items'   => ItemIndexResource::collection($items)->response()->getData(true)
        ], 200);
    }

    public function resubmittedIndex(): JsonResponse
    {
        $items = $this->itemReviewService->getItemsByStatus('resubmitted');

        return response()->json([
            'success' => true,
            'counts'  => $this->itemReviewService->getStatusCounts(),
            'items'   => ItemIndexResource::collection($items)->response()->getData(true)
        ], 200);
    }
}
