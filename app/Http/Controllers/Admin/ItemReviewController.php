<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Services\ItemReviewService;
use App\Services\NotificationService;
use App\Http\Requests\Admin\ItemStatusUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ItemReviewController extends Controller
{
    public function __construct(
        protected ItemReviewService $reviewService
    ) {}

    public function pendingIndex(): View
    {
        return view('admin.item-review.pending', [
            'items'  => $this->reviewService->getItemsByStatus('pending'),
            'counts' => $this->reviewService->getStatusCounts()
        ]);
    }

    public function pendingShow(int $id): View
    {
        $item = Item::with('histories')->findOrFail($id);
        return view('admin.item-review.showItem', compact('item'));
    }

    public function updateStatus(ItemStatusUpdateRequest $request, int $id): RedirectResponse
    {
        $item = Item::findOrFail($id);

        $isAdmin = Auth::guard('admin')->user()->hasRole('superadmin');
        $isPendingOrResubmitted = in_array($item->status, ['pending', 'resubmitted']);

        if (!$isAdmin && !$isPendingOrResubmitted) {
            NotificationService::error('You cannot change the status after it has been processed.');
            return redirect()->back();
        }

        $this->reviewService->updateStatus(
            $item,
            $request->validated(),
            Auth::guard('admin')->id() ?? auth()->id()
        );

        NotificationService::updated('Item status updated and logged successfully.');
        return redirect()->back();
    }

    public function approveIndex(): View
    {
        return view('admin.item-review.approved-index', [
            'items'  => $this->reviewService->getItemsByStatus('active'),
            'counts' => $this->reviewService->getStatusCounts()
        ]);
    }

    public function softRejectedIndex(): View
    {
        return view('admin.item-review.soft-rejected-index', [
            'items'  => $this->reviewService->getRejectedItems('soft_reject'),
            'counts' => $this->reviewService->getStatusCounts()
        ]);
    }

    public function hardRejectedIndex(): View
    {
        return view('admin.item-review.hard-rejected-index', [
            'items'  => $this->reviewService->getRejectedItems('hard_reject'),
            'counts' => $this->reviewService->getStatusCounts()
        ]);
    }

    public function resubmittedIndex(): View
    {
        return view('admin.item-review.resubmitted-index', [
            'items'  => $this->reviewService->getItemsByStatus('resubmitted'),
            'counts' => $this->reviewService->getStatusCounts()
        ]);
    }
}
