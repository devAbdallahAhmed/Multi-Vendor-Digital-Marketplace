<?php

namespace App\Listeners;

use App\Events\ItemStatusUpdated;
use App\Models\ItemHistory;

class LogItemHistory
{
    public function handle(ItemStatusUpdated $event): void
    {
        $history = new ItemHistory();
        $history->item_id     = $event->item->id;
        $history->status      = $event->status;
        $history->author_id   = $event->item->author_id;
        $history->reviewer_id = $event->reviewerId;

        switch ($event->status) {
            case 'approved':
                $history->title = 'Item Approved';
                $history->body  = 'Congratulations! Your item has been approved and is now active.';
                break;

            case 'soft_reject':
                $history->title = 'Item Soft Rejected';
                $history->body  = $event->reason;
                break;

            case 'hard_reject':
                $history->title = 'Item Hard Rejected';
                $history->body  = $event->reason;
                break;

            default:
                $history->title = 'Status Reset to Pending';
                $history->body  = 'The item has been put back in the pending queue.';
                break;
        }

        $history->save();
    }
}