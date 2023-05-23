<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index(Request $request)
    {
        $path = $request->path();
        $path = explode('/',$path);
        $title = end($path);

        $patients = \App\Models\Registration::where('isFinish',0)->where('registrationDate',date('Y-m-d'))->get();
        $medicines = \App\Models\Medicine::all();


        return view('pages.medical-record',[
            'title'=>$title,
            'patients'=>$patients,
            'medicines'=>$medicines
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "patientID" => 'required',
            "goldar" => 'required',
            "complaint" => 'required',
            "diagnosis" => 'required',
            'medicines'=>'required'
        ]);
        $action = $request->actions;
        $result = $request->results;

        $actions = [];
        for ($i=0; $i < count($action); $i++) {
            array_push($actions,[
                'action'=>$action[$i],
                'result'=>$result[$i]
            ]);
        }
        $generateCode = $this->generateCode();
        \App\Models\MedicalRecord::create([
            'medicalRecordID'=>$generateCode,
            'patientID'=>$request->patientID,
            'doctorID'=>auth()->user()->prefixID,
            'complaint'=>$request->complaint,
            'diagnosis'=>$request->diagnosis,
            'goldar'=>$request->goldar,
            'action'=>json_encode($actions),
            'medicine'=>$request->medicines,
            'checkDate'=>date('Y-m-d'),
            'checkTime'=>date('H:i:s'),
        ]);

        \App\Models\Registration::where('patientID',$request->patientID)->where('registrationDate',date('Y-m-d'))->update([
            'isFinish'=>1,
            'checkTime'=>date('H:i:s'),
            'checkDate'=>date('Y-m-d'),
            'doctorID'=>auth()->user()->prefixID,
            'medicalRecordID'=>$generateCode
        ]);

        event(new \App\Events\QueueEvent());

        return redirect()->back()->with(['message'=>'Success']);
    }

    public function generateCode()
    {
        $count = \App\Models\MedicalRecord::count();
        $count += 1;
        return 'RM '.date('Y').'.'.date('m').'.'.date('d').'.'.$count;
    }

    public function json(Request $request)
    {
        return \App\Models\MedicalRecord::with(['doctor','patient'])->where('patientID',$request->patientID)->get();
    }
}
