<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemporaryTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'flag' => $this->flag,
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'date' => $this->date->format('d/m/Y'),
            'status' => $this->status,
        ];
    }
}
