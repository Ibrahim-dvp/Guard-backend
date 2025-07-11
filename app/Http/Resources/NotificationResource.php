<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'type' => $this->type,
            'title' => $this->title,
            'message' => $this->message,
            'read_at' => $this->read_at,
            'recipient' => new UserResource($this->whenLoaded('recipient')),
            'sender' => new UserResource($this->whenLoaded('sender')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
