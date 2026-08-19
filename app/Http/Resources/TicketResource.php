<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'status' => $this->status,

            'created_by' => $this->createdBy ? $this->createdBy->name . ' ' . $this->createdBy->surname : null,
            'assigned_to' => $this->assignedTo ? $this->assignedTo->name . ' ' . $this->assignedTo->surname : null,

            'created_at' => $this->created_at->format('d-m-Y | H:i'),
            'updated_at' => $this->updated_at->format('d-m-Y | H:i'),

            'categories' => $this->categories,
        ];
    }
}
