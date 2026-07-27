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

            'created_by' => $this->created_by->name . ' ' . $this->created_by->surname,
            'assigned_to' => $this->assigned_to->name . ' ' . $this->assigned_to->surname,

            'created_at' => $this->created_at->format('d-m-Y | H:i'),
            'updated_at' => $this->updated_at->format('d-m-Y | H:i'),
        ];
    }
}
