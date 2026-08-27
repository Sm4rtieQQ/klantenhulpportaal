<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'ticket_id' => $this->ticket_id,
            'created_by' => $this->createdBy ? $this->createdBy->name . ' ' . $this->createdBy->surname : null,
            'body' => $this->body,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
