<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class SettingsController extends Controller
{
    /**
     * Display the page with all user settings.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('User/Settings');
    }
}
