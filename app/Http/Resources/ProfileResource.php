<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Phone' => $this->phone,
            'Address' => $this->address,
            'Image' => $this->image,
            'Date_of_Birth' => $this->date_of_birth,
        ];
    }
}
