<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KycResource extends JsonResource
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
            'document_type' => $this->document_type,
            'document_number' => $this->document_number,
            'status' => $this->status ?? 'pending',
            'documents' => $this->documents,
            'submitted_at' => $this->created_at->format('y-m-d H:i:s'),

        ];
    }
}
