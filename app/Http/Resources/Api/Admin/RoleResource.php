<?php

namespace App\Http\Resources\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
   public function toArray(Request $request): array
{
   return [
    'id'         => $this->id,
    'full_name'  => $this->name,
    'email'      => $this->email,
    'roles'      => RoleResource::collection($this->whenLoaded('roles')),
    'created_at' => $this->created_at->format('Y-m-d'),
];
}
}
