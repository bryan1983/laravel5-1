<?php

namespace Curso\Http\Controllers;

use Illuminate\Http\Request;

use Curso\Http\Requests;

class CommentsController extends Controller
{
    public function submit(Request $request)
    {
        dd($request->all());
    }
}
