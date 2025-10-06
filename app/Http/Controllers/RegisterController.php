<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\RegistrationService;
use Illuminate\Contracts\View\View;

class RegisterController extends Controller
{
    public function __construct(
        private RegistrationService $registrationService
    ) {}

    public function index(): View
    {
        return view('register');
    }

    public function store(RegisterRequest $request): View
    {
        $link = $this->registrationService->registerUserAndCreateAccessLink($request->getDTO());

        return view('register-success', ['link' => $link]);
    }
}
