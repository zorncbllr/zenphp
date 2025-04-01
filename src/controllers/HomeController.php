<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class HomeController extends Controller
{
    function index(Request $request)
    {
        return view('home');
    }
}
