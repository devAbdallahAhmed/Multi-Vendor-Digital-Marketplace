<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'preview_type' => $this->preview_type,
            'preview_image_url' => $this->getPreviewUrl(),
        ];
    }

    private function getPreviewUrl()
    {
        if ($this->preview_type === 'image' && $this->preview_image) {
            return asset($this->preview_image);
        }

        if ($this->preview_type === 'video' && $this->preview_video) {
            return asset('defaults/video.webp');
        }

        if ($this->preview_type === 'audio' && $this->preview_audio) {
            return asset('defaults/audio.webp');
        }

    }
}
