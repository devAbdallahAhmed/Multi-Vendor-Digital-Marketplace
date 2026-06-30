<?php

namespace App\Services\Admin;

use App\Models\Item;
use App\Events\ItemStatusUpdated;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ItemReviewService
{

    public function getItemsByStatus(string $status): LengthAwarePaginator
    {
        return Item::where('status', $status)->paginate(10);
    }


    public function getRejectedItems(string $rejectType): LengthAwarePaginator
    {
        return Item::where('status', 'inactive')
            ->whereHas('histories', function ($q) use ($rejectType) {
                $q->where('status', $rejectType);
            })
            ->paginate(10);
    }


    public function getStatusCounts(): array
    {
        return [
            'pending'     => Item::where('status', 'pending')->count(),
            'resubmitted' => Item::where('status', 'resubmitted')->count(),
            'approved'    => Item::where('status', 'active')->count(),
            'soft_reject' => Item::where('status', 'inactive')->whereHas('histories', fn($q) => $q->where('status', 'soft_reject'))->count(),
            'hard_reject' => Item::where('status', 'inactive')->whereHas('histories', fn($q) => $q->where('status', 'hard_reject'))->count(),
        ];
    }


    public function updateStatus(Item $item, array $data, int $reviewerId): Item
    {
        $statusMapping = [
            'approved' => 'active',
            'pending'  => 'pending',
        ];

        $item->status = $statusMapping[$data['status']] ?? 'inactive';
        $item->save();

        event(new ItemStatusUpdated(
            item: $item,
            status: $data['status'],
            reason: $data['reason'] ?? null,
            reviewerId: $reviewerId
        ));

        return $item;
    }
}
