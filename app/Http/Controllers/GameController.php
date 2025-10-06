<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResultResource;
use App\Services\GameService;
use App\Models\AccessLink;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GameController extends Controller
{
    public function __construct(
        private GameService $gameService
    ) {}

    public function play(AccessLink $accessLink): GameResultResource
    {
        $gameResult = $this->gameService->playGame($accessLink->user);

        return new GameResultResource($gameResult);
    }

    public function history(AccessLink $accessLink): AnonymousResourceCollection
    {
        $results = $this->gameService->getLastResults($accessLink->user);

        return GameResultResource::collection($results);
    }
}