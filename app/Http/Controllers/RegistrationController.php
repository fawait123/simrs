<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $path = $request->path();
        $path = explode('/',$path);
        $title = end($path);


        return view('pages.registration',[
            'title'=>$title
        ]);
    }
}
