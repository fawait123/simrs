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
                'title'=>$path
            ]);
        }

        return abort(404);
    }

    public function create(Request $request)
    {
        if(view()->exists($request->path())){
            $path = explode('/',$request->path());
            $path = end($path);
            $specialist = null;
            if($path == 'doctor'){
                $specialist = \App\Models\Specialist::latest()->get();
            }
            return view($request->path(),[
                'title'=>'Create '.$path,
                'specialist'=>$specialist
            ]);
        }

        return abort(404);
    }

    public function edit(Request $request)
    {
        $path = $request->path();
        $path = explode('/',$path);

        if(count($path) != 5){
            return abort(404);
        }

        $id = end($path);
        $newPath = array_splice($path,0,4);
        $newPath = join("/",$newPath);


        if(view()->exists($newPath)){
            $nPath = explode('/',$newPath);
            $nPath = end($nPath);
            $model = '\\App\\Models\\'.$nPath;
            $model  = new $model;
            $data = $model->find($id);
            $specialist = null;
            if($nPath == 'doctor'){
                $specialist = \App\Models\Specialist::latest()->get();
            }
            if($data){
                return view($newPath,[
                    'title'=>'Edit '.$nPath,
                    'data'=>$data,
                    'id'=>$id,
                    'specialist'=>$specialist
                ]);
            }

            return abort(404);
        }

        return abort(404);
    }

    public function doctorStore(Request $request)
    {
        \App\Models\Doctor::create($request->all());

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $model = "\\App\\Models\\".$request->model;
        $model = new $model;

        $find = $model->find($request->id);
        $find->delete();
        return true;
    }

    public function removeImages(Request $request)
    {
        return $request->all();
    }
}
