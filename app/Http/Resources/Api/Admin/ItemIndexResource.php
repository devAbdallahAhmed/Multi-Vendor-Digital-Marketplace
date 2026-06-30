<?php

namespace App\Http\Resources\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'preview_type'   => $this->preview_type,
            'price'          => $this->price,
            'discount_price' => $this->discount_price ?? null,
            'status'         => $this->status,
            'created_at'     => $this->created_at ? $this->created_at->format('Y-m-d') : null,
        ];
    }
}
