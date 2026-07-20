<?php

namespace App\Http\Resources\Api\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'products_details' => [
                'item' => $this->item?->name,
                'preview_type' => $this->item?->preview_type,
                'preview_url' =>  $this->getPreviewUrl(),
                'category' => $this->item->category->name,
                'sub_category' => $this->item->sub_category->name,
            ],
            'created_at' => $this->created_at->format('M d, Y'),

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
