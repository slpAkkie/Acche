<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display a home page.
     *
     * @return Response
     */
    public function home(): Response
    {
        return Inertia::render('Home');
    }
}
