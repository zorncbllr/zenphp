<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

class RootController extends Controller
{
    function index(Request $request)
    {
        return view('home');
    }
}
