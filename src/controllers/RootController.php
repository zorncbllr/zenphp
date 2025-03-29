<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class RootController extends Controller
{
    function index(Request $request)
    {
        return json(['body' => $request->body]);
    }
}
