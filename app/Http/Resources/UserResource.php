<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            '' =>'------------ User Information ------------',
            'ID' => $this->id,
            'Name' => $this->name,
            'Email' => $this->email,
            'Created_At' => $this->created_at->format('y/m/d'),
            'Profile' => new ProfileResource($this->whenLoaded('profile')),
            ' ' =>'--------------------------------------------'
        ];
    }
}
