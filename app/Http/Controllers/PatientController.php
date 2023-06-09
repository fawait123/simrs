<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use File;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $startDate = Carbon::parse($request->birthdate);
        $endDate = Carbon::parse(date('Y-m-d'));
        $age = $startDate->diffInDays($endDate);
        $photos = null;
        if($request->hasFile('photos')){
            $file = $request->file('photos');
            $mimeType = $file->getMimeType();
            $mimeType = explode('/',$mimeType);
            $filename = date('YmdHis').rand().'.'. $mimeType[1];
            $file->move('uploads',$filename);
            $photos = 'uploads/'.$filename;
        }

        $ktp = null;

        if($request->hasFile('ktp')){
            $file = $request->file('ktp');
            $mimeType = $file->getMimeType();
            $mimeType = explode('/',$mimeType);
            $filename = date('YmdHis').rand().'.' .$mimeType[1];
            $file->move('uploads',$filename);
            $ktp = 'uploads/'.$filename;
        }

        $regionals = json_encode([
            'province'=>$request->provinces,
            'district'=>$request->districts,
            'subdistrict'=>$request->subdistricts,
            'village'=>$request->villages,
        ]);
        \App\Models\Patient::create([
            "nik" => $request->nik,
            "name" => $request->name,
            "gender" => $request->gender,
            "placebirth" => $request->placebirth,
            "birthdate" => $request->birthdate,
            "academic" => $request->academic,
            "religion" => $request->religion,
            "work" => $request->work,
            "province" => explode(':',$request->provinces)[1],
            "district" => explode(':',$request->districts)[1],
            "subdistrict" => explode(':',$request->subdistricts)[1],
            "village" => explode(':',$request->villages)[1],
            "regionals"=>$regionals,
            "rtrw" => $request->rt .'/'.$request->rw,
            "phone" => $request->phone,
            "email" => $request->email,
            "photos" => $photos,
            "ktp" => $ktp,
            "age"=>$age
        ]);


        return redirect('pages/master/patient')->with(['message'=>'Data Created Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient = \App\Models\Patient::find($id);

        if(!$patient){
            return redirect('pages/master/patient')->with(['message'=>'Data doesnt match to our record']);
        }


        $startDate = Carbon::parse($request->birthdate);
        $endDate = Carbon::parse(date('Y-m-d'));
        $age = $startDate->diffInDays($endDate);

        $photos = $patient->photos;

        if($request->hasFile('photos')){
            $this->removeImage($patient->photos);
            $file = $request->file('photos');
            $mimeType = $file->getMimeType();
            $mimeType = explode('/',$mimeType);
            $filename = date('YmdHis').rand().'.'. $mimeType[1];
            $file->move('uploads',$filename);
            $photos = 'uploads/'.$filename;
        }

        $ktp = $patient->ktp;

        if($request->hasFile('ktp')){
            $this->removeImage($patient->ktp);
            $file = $request->file('ktp');
            $mimeType = $file->getMimeType();
            $mimeType = explode('/',$mimeType);
            $filename = date('YmdHis').rand().'.' .$mimeType[1];
            $file->move('uploads',$filename);
            $ktp = 'uploads/'.$filename;
        }

        $regionals = json_encode([
            'province'=>$request->provinces,
            'district'=>$request->districts,
            'subdistrict'=>$request->subdistricts,
            'village'=>$request->villages,
        ]);

        \App\Models\Patient::where('id',$id)->update([
            "nik" => $request->nik,
            "name" => $request->name,
            "gender" => $request->gender,
            "placebirth" => $request->placebirth,
            "birthdate" => $request->birthdate,
            "academic" => $request->academic,
            "religion" => $request->religion,
            "work" => $request->work,
            "province" => explode(':',$request->provinces)[1],
            "district" => explode(':',$request->districts)[1],
            "subdistrict" => explode(':',$request->subdistricts)[1],
            "village" => explode(':',$request->villages)[1],
            "regionals"=>$regionals,
            "rtrw" => $request->rt .'/'.$request->rw,
            "phone" => $request->phone,
            "email" => $request->email,
            "photos" => $photos,
            "ktp" => $ktp,
            "age"=>$age
        ]);

        return redirect('pages/master/patient')->with(['message'=>'Data Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function removeImage($path)
    {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}
