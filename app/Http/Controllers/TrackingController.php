<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $path = $request->path();
        $path = explode('/',$path);
        $title = end($path);


        return view('pages.tracking',[
            'title'=>$title
        ]);
    }
}
