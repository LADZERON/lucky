<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccessLinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'new_link' => route('access.page', ['accessLink' => $this]),
            'expires_at' => $this->expires_at->format('d.m.Y H:i'),
        ];
    }

    /**
     * Disable wrapping for this resource
     */
    public static function withoutWrapping()
    {
        return true;
    }
}
