<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index(Request $request)
    {
        $path = $request->path();
        $path = explode('/',$path);
        $title = end($path);


        return view('pages.queue',[
            'title'=>$title
        ]);
    }

    public function json()
    {
        $data = \App\Models\Registration::where('registrationDate',date('Y-m-d'))->where('isFinish',0)->orderBy('registrationID','ASC')->get();
        return json_encode([
            'results'=>$data
        ]);
    }
}
