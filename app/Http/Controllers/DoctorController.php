<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
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

        $regionals = json_encode([
            'province'=>$request->provinces,
            'district'=>$request->districts,
            'subdistrict'=>$request->subdistricts,
            'village'=>$request->villages,
        ]);
        $doctor = \App\Models\Doctor::create([
            "nik" => $request->nik,
            "nip" => $request->nip,
            "name" => $request->name,
            "gender" => $request->gender,
            "placebirth" => $request->placebirth,
            "birthdate" => $request->birthdate,
            "academic" => $request->academic,
            "degree" => $request->degree,
            "religion" => $request->religion,
            "province" => explode(':',$request->provinces)[1],
            "district" => explode(':',$request->districts)[1],
            "subdistrict" => explode(':',$request->subdistricts)[1],
            "village" => explode(':',$request->villages)[1],
            "regionals"=>$regionals,
            "rtrw" => $request->rt .'/'.$request->rw,
            "phone" => $request->phone,
            "email" => $request->email,
            "specialistID" => $request->specialist,
            "photos" => $photos,
            "age"=>$age
        ]);

        $this->createorUpdateUser($doctor);

        return redirect('pages/master/doctor')->with(['message'=>'Data Created successfully']);
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
        $doctor = \App\Models\Doctor::find($id);

        $this->createorUpdateUser($doctor);

        if(!$doctor){
            return redirect('pages/master/doctor')->with(['message'=>'Data doesnt match to our record']);
        }


        $startDate = Carbon::parse($request->birthdate);
        $endDate = Carbon::parse(date('Y-m-d'));
        $age = $startDate->diffInDays($endDate);
        $photos = $doctor->photos;
        if($request->hasFile('photos')){
            $this->removeImage($doctor->photos);
            $file = $request->file('photos');
            $mimeType = $file->getMimeType();
            $mimeType = explode('/',$mimeType);
            $filename = date('YmdHis').rand().'.'. $mimeType[1];
            $file->move('uploads',$filename);
            $photos = 'uploads/'.$filename;
        }

        $regionals = json_encode([
            'province'=>$request->provinces,
            'district'=>$request->districts,
            'subdistrict'=>$request->subdistricts,
            'village'=>$request->villages,
        ]);
        \App\Models\Doctor::where('id',$id)->update([
            "nik" => $request->nik,
            "nip" => $request->nip,
            "name" => $request->name,
            "gender" => $request->gender,
            "placebirth" => $request->placebirth,
            "birthdate" => $request->birthdate,
            "academic" => $request->academic,
            "degree" => $request->degree,
            "religion" => $request->religion,
            "province" => explode(':',$request->provinces)[1],
            "district" => explode(':',$request->districts)[1],
            "subdistrict" => explode(':',$request->subdistricts)[1],
            "village" => explode(':',$request->villages)[1],
            "regionals"=>$regionals,
            "rtrw" => $request->rt .'/'.$request->rw,
            "phone" => $request->phone,
            "email" => $request->email,
            "specialistID" => $request->specialist,
            "photos" => $photos,
            "age"=>$age
        ]);

        return redirect('pages/master/doctor')->with(['message'=>'Data Created successfully']);
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

    public function createorUpdateUser($data)
    {
        $user = \App\Models\User::where('prefixID',$data->id)->first();

        if($user){
            // update
            \App\Models\User::where('prefixID',$data->id)->update([
                'name'=>$data->name.', '. $data->degree,
                'email'=>$data->email,
            ]);
        }else{
            // create
            \App\Models\User::create([
                'name'=>$data->name.', '. $data->degree,
                'email'=>$data->email,
                'password'=>Hash::make('12345678'),
                'role'=>'doctor',
                'prefixID'=>$data->id,
                'prefix'=>'\App\Models\User',
                'is_verified'=>true
            ]);
        }

    }
}
