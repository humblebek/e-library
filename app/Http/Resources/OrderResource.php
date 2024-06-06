<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'Client ID' => $this->client_id,
            'Book ID' => $this->book_id,
            'Took Date' => $this->takDate,
            'Return Date' => $this->retDate,
            'Status' => $this->status,
        ];
    }
}
