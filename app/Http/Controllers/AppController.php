<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class AppController extends Controller
{

    /**
     * @return View|Factory|Application
     */
    public function index(Request $request): View|Factory|Application
    {
        return view('welcome');
    }

}
