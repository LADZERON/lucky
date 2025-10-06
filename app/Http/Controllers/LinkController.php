<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccessLinkResource;
use App\Models\AccessLink;
use App\Services\AccessLinkService;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    public function __construct(
        private AccessLinkService $accessLinkService
    ) {}

    public function regenerate(AccessLink $accessLink): AccessLinkResource
    {
        $newAccessLink = $this->accessLinkService->regenerateAccessLink($accessLink);

        return new AccessLinkResource($newAccessLink);
    }

    public function deactivate(AccessLink $accessLink): JsonResponse
    {
        $success = $this->accessLinkService->deactivateAccessLink($accessLink);
        
        $message = $success 
            ? 'Посилання деактивовано' 
            : 'Посилання не знайдено';

        return response()->json(['message' => $message]);
    }
}