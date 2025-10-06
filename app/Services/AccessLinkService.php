<?php

namespace App\Services;

use App\Models\AccessLink;
use App\Models\User;
use Illuminate\Support\Str;

class AccessLinkService
{
    private const TOKEN_LENGTH = 32;
    private const EXPIRES_IN_DAYS = 7;

    public function generateAccessLink(User $user): AccessLink
    {
        [$token, $expiresAt] = $this->generateTokenWithExpiration();

        return AccessLink::updateOrCreate([
            'user_id' => $user->id,
        ], [
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);
    }

    public function regenerateAccessLink(AccessLink $accessLink): AccessLink
    {
       [$token, $expiresAt] = $this->generateTokenWithExpiration();

        $accessLink->update([
            'token' => $token,
            'expires_at' => $expiresAt,
        ]);

        return $accessLink;
    }

    public function deactivateAccessLink(AccessLink $accessLink): bool
    {
        return $accessLink->update(['expires_at' => now()]);
    }

    private function generateTokenWithExpiration(): array
    {
        return [
            Str::random(self::TOKEN_LENGTH), 
            now()->addDays(self::EXPIRES_IN_DAYS)
        ];
    }
}
