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


        $data = \App\Models\Registration::where('medicalRecordID',$request->medicalRecordID)->first();
        $medicalrecord = \App\Models\MedicalRecord::where('medicalRecordID',$request->medicalRecordID)->first();

        return view('pages.tracking',[
            'title'=>$title,
            'data'=>$data,
            'medicalrecord'=>$medicalrecord
        ]);
    }
}
