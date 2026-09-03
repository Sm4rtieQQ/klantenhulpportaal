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
        $statusDescription = function (int $status): string {
            return match ($status) {
                1 => 'new',
                2 => 'pending',
                3 => 'in_progress',
                4 => 'completed',
                5 => 'abandoned',
                default => 'unknown'
            };
        };

        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'status' => $this->status,
            'status_description' => $statusDescription($this->status),

            'created_by' => $this->createdBy->name . ' ' . $this->createdBy->surname,
            'created_by_id' => $this->createdBy->id,
            'assigned_to' => $this->assignedTo ? $this->assignedTo->name . ' ' . $this->assignedTo->surname : null,
            'assigned_to_id' => $this->assignedTo ? $this->assignedTo->id : null,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'categories' => $this->categories,
        ];
    }
}
