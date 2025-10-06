<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'random_number' => $this->random_number,
            'result' => $this->result,
            'win_amount' => $this->win_amount,
            'created_at' => $this->created_at->format('d.m.Y H:i'),
        ];
    }
}
