<?php

namespace App\Services;

use App\DTOs\RegisterDTO;
use App\Models\User;

class RegistrationService
{
    public function __construct(
        private AccessLinkService $accessLinkService
    ) {}

    public function registerUserAndCreateAccessLink(RegisterDTO $userData): string
    {
        $user = $this->registerUser($userData);
        $accessLink = $this->accessLinkService->generateAccessLink($user);
        return route('access.page', ['accessLink' => $accessLink]);
    }

    public function registerUser(RegisterDTO $userData): User
    {
        return User::updateOrCreate([
            'username' => $userData->username,
        ], [
            'phonenumber' => $userData->phonenumber,
        ]);
    }
}
