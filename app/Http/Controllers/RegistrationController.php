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
            'title'=>$title,
            'patients'=>auth()->user()->identity->patients
        ]);
    }

    public function submit(Request $request)
    {
        $check = \App\Models\Registration::where('patientID',$request->patientID)->where('registrationDate',date('Y-m-d'))->first();
        if($check){
            return redirect()->back()->withErrors(['patientID'=>"Pasien sudah didaftarkan"]);
        }
        $request->validate([
            'patientID'=>"required"
        ]);

        \App\Models\Registration::create([
            'userID'=>auth()->user()->id,
            'patientID'=>$request->patientID,
            'registrationID'=>$this->generateCode(),
            'registrationDate'=>date('Y-m-d'),
            'registrationTime'=>date('H:i:s'),
        ]);

        event(new \App\Events\QueueEvent());

        return redirect()->route('list.queue')->with(['message'=>"Data created successfully"]);
    }

    public function generateCode()
    {
        $count = \App\Models\Registration::where('registrationDate',date('Y-m-d'))->count();
        $count += 1;
        return date('Y').'.'.date('m').'.'.date('d').'.'.$count;
    }
}
