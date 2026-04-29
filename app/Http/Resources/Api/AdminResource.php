<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Admin\RoleResource;
class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
   public function toArray(Request $request): array {
    return [
        'id' => $this->id,
        'full_name' => $this->name,
        'email' => $this->email,
        'location' => [
            'country' => $this->country,
            'city' => $this->city,
        ],

        'roles' => $this->getRoleNames(), 
        'roles_details' => RoleResource::collection($this->whenLoaded('roles')),
        'avatar_url' => $this->avatar ? asset($this->avatar) : null,
    ];
}
}
