<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\doctor;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        if(view()->exists($request->path())){
            $path = explode('/',$request->path());
            $path = end($path);
            $model = '\\App\\Models\\'.$path;
            $model  = new $model;
            return view($request->path(),[
                'data'=>$model->get(),
                'title'=>ucfirst($path)
            ]);
        }

        return abort(404);
    }

    public function doctorStore(Request $request)
    {
        \App\Models\Doctor::create($request->all());

        return redirect()->back();
    }
}
