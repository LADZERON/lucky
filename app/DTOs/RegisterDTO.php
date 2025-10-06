<?php

namespace App\DTOs;

/**
 * @property string $username
 * @property string $phonenumber
 */
class RegisterDTO
{
    public function __construct(
        public string $username,
        public string $phonenumber,
    ) {}
}