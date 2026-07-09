<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'user_name'  => Auth::user()->name,
            'item_name'  => $this->item?->name,
            'price'      => $this->item?->discount_price > 0 ? $this->item->discount_price : $this->item->price,
            'created_at' => $this->created_at?->format('Y-m-d'),
        ];
    }
}
