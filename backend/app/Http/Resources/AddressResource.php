<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'address' => $this->city,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'province' => $this->province ?[
                'province_id' => $this->province->id,
                'province_name' => $this->province->province_name,
                'image' => $this->province->image,
            ] : null,
        ];
    }
}
