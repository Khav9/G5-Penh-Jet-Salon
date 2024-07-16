<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardItemResource extends JsonResource
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
            'service_id' => $this->service_id,
            'quantity' => $this->quantity,
            'store_id' => $this->service->store_id,
            'service' => [
                'service_name' => $this->service->service_name,
                'price' => $this->service->price,
                'discount' => $this->service->discount,
                'image' => $this->service->image,
            ]
        ];
    
    }
}
