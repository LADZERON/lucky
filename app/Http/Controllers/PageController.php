<?php

namespace App\Http\Controllers;

use App\Models\AccessLink;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function show(AccessLink $accessLink): View
    {
        return view('access-page', [
            'user' => $accessLink->user,
            'accessLink' => $accessLink
        ]);
    }
}