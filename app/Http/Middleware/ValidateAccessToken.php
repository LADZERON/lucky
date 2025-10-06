<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccessLink;
use Symfony\Component\HttpFoundation\Response;

class ValidateAccessToken
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var AccessLink $accessLink */
        $accessLink = $request->route('accessLink');

        if (!$accessLink || $accessLink->isExpired()) {
            return response()->view('access-expired', ['message' => 'Посилання не дійсне'], 403);
        }

        return $next($request);
    }
}