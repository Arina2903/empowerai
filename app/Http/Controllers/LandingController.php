<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
}

