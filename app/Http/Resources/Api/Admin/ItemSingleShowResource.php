<?php

namespace App\Http\Resources\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemSingleShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Details' => [
                'id'             => $this->id,
                'name'           => $this->name,
                'preview_type'   => $this->preview_type,
                'price'          => $this->price,
                'discount_price' => $this->discount_price ?? null,
                'support'        => $this->is_supported == 1 ? 'Support' : 'Not Support',
                'is_free'        => $this->is_free == 1 ? 'Yes' : 'No',
                'created_at'     => $this->created_at ? $this->created_at->format('Y-m-d') : null,
                'status'         => $this->status,
            ],
            'Histories' => $this->histories->map(
                function ($history) {
                    return [
                        'title'  => $history->title ?? "No Title",
                        'status' => $history->status ?? "",
                    ];
                }
            ),
        ];
    }
}
