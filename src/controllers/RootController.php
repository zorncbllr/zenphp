<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class RootController extends Controller
{
    function index($msg = '')
    {
        return view('home', [
            'msg' => $msg
        ]);
    }

    function create(Request $request)
    {
        return $this->index(
            msg: $request->text
        );
    }
}
