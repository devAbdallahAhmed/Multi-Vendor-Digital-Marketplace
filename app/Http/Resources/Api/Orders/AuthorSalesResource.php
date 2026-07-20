<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorSalesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'author_commission_rate' => $this->author_commission_rate,
            'author_earning' => $this->author_earning,
            'date' => $this->created_at->format('M d, Y'),
            'item' => [
                'id' => $this->item?->id,
                'name' => $this->item?->name,
                'slug' => $this->item?->slug,
                'preview_type' => $this->item?->preview_type,
                'preview_url' => $this->getPreviewUrl(),
            ],
        ];
    }

    private function getPreviewUrl(): ?string
    {
        if (!$this->item) {
            return null;
        }

        if ($this->item->preview_type === 'image' && $this->item->preview_image) {
            return asset($this->item->preview_image);
        }

        if ($this->item->preview_type === 'video' && $this->item->preview_video) {
            return asset('defaults/video.webp');
        }

        if ($this->item->preview_type === 'audio' && $this->item->preview_audio) {
            return asset('defaults/audio.webp');
        }

        return null;
    }
}
