<?php

namespace App\Http\Resources;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class commentResource extends JsonResource
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
            'user_name' => $this->user->name ?? null,
            'user_profile' => $this->user->profile ?? null,
            'text' => $this->text,
            'image' => $this->image,
            'created_at' => Carbon::parse($this->created_at)->setTimezone('Asia/Phnom_Penh')->format('H:i'),
            'replies' => $this->replies->map(function ($reply) {
                return [
                    'id' => $reply->id,
                    'text' => $reply->text,
                    'image' => $reply->image,
                    'created_at' => Carbon::parse($reply->created_at)->setTimezone('Asia/Phnom_Penh')->format('H:i'),
                    'owner' => [
                        'name' => $reply->owner->name ?? null,
                        'profile' => $reply->owner->profile ?? null,
                    ],
                ];
            }),
        ];
    }
    
}
