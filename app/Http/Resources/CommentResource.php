<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'created_by' => $this->createdBy->name . ' ' . $this->createdBy->surname,
            'created_by_id' => $this->created_by_id,
            'body' => $this->body,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
