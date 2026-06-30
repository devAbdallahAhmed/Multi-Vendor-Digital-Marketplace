<?php

namespace App\Events;

use App\Models\Item;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
class ItemStatusUpdated
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public Item $item;
    public string $status;
    public ?string $reason;
    public int $reviewerId;

    public function __construct(Item $item, string $status, ?string $reason, int $reviewerId)
    {
        $this->item = $item;
        $this->status = $status;
        $this->reason = $reason;
        $this->reviewerId = $reviewerId;
    }
}
