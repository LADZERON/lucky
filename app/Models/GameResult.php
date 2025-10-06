<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class GameResult extends Model
{
    protected $fillable = [
        'user_id',
        'random_number',
        'is_win',
        'win_amount',
    ];

    protected $casts = [
        'is_win' => 'boolean',
        'win_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function result(): Attribute
    {
        return new Attribute(
            get: fn () => $this->is_win ? 'Win' : 'Lose',
        );
    }
}
