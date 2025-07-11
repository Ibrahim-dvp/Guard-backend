<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
            'location' => $this->location,
            'lead' => new LeadResource($this->whenLoaded('lead')),
            'sales_agent' => new UserResource($this->whenLoaded('salesAgent')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
