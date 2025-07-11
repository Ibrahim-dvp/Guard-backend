<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
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
            'uuid' => $this->uuid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'status' => $this->status,
            'source' => $this->source,
            'notes' => $this->notes,
            'user' => new UserResource($this->whenLoaded('user')),
            'assignedTo' => new UserResource($this->whenLoaded('assignedTo')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
