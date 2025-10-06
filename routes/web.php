<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::prefix('access')
    ->middleware(['validate.access.token'])
    ->group(function () {
        Route::get('/{accessLink:token}', [PageController::class, 'show'])
            ->name('access.page');
        
        Route::post('/{accessLink:token}/regenerate', [LinkController::class, 'regenerate'])
            ->name('access.regenerate');
        
        Route::post('/{accessLink:token}/deactivate', [LinkController::class, 'deactivate'])
            ->name('access.deactivate');
        
        Route::post('/{accessLink:token}/play', [GameController::class, 'play'])
            ->name('access.play');
        
        Route::get('/{accessLink:token}/history', [GameController::class, 'history'])
            ->name('access.history');
    });
