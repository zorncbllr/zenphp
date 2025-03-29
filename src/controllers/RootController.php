<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class RootController extends Controller
{
    function index(Request $request)
    {

        return view('home');
    }

    function create(Request $request) {}
}
