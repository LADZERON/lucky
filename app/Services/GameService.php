<?php

namespace App\Services;

use App\Models\GameResult;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GameService
{
    private const LIMIT_RESULTS = 3;
    
    public function playGame(User $user): GameResult
    {
        $randomNumber = rand(1, 1000);
        $isWin = $randomNumber % 2 === 0;
        $winAmount = $isWin ? $this->calculateWinAmount($randomNumber) : 0;

        return GameResult::create([
            'user_id' => $user->id,
            'random_number' => $randomNumber,
            'is_win' => $isWin,
            'win_amount' => $winAmount,
        ]);
    }

    /**
     * @return Collection<int, GameResult>
     */ 
    public function getLastResults(User $user): Collection
    {
        return $user->gameResults()
            ->orderBy('created_at', 'desc')
            ->limit(self::LIMIT_RESULTS)
            ->get();
    }

    private function calculateWinAmount(int $randomNumber): float
    {
        $winRates = [
            900 => 0.7,
            600 => 0.5,
            300 => 0.3,
            0 => 0.1,
        ];

        foreach ($winRates as $threshold => $rate) {
            if ($randomNumber > $threshold) {
                return $randomNumber * $rate;
            }
        }

        return $randomNumber * 0.1; // fallback
    }
}
