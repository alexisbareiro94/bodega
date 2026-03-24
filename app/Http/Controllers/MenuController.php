<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Show the application menu.
     */
    public function index(): View
    {
        return view('menu');
    }
}
