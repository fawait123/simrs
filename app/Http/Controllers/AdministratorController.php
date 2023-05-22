<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function index(Request $request)
    {
        $path = $request->path();
        $path = explode('/',$path);
        $title = end($path);

        $patient = \App\Models\Registration::where('registrationDate',date('Y-m-d'))->get();
        return view('pages.administrator',[
            'title'=>$title,
            'patients'=>$patient
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'patientID'=>'required',
            'statuses'=>'required',
            'price'=>'required'
        ]);

        \App\Models\Registration::where('patientID',$request->patientID)->where('registrationDate',date('Y-m-d'))->update([
            'status'=>$request->statuses,
            'price'=>$request->price
        ]);

        return redirect()->back()->with(['message'=>'Data updated successfully']);
    }

    public function json(Request $request)
    {
        $administrator = \App\Models\Registration::where('patientID',$request->id)->where('registrationDate',date('Y-m-d'))->first();

        return $administrator;
    }
}
