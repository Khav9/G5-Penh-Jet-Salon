<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListBookingResource extends JsonResource
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
            'shop_name' => $this->store->shop_name ? : null,
            'date' => $this->date,
            'time' => $this->time,
            'total_price' => $this->total_price,
            'status' => $this->status,
        ];
    }
}
