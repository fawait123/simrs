<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        return view('home');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function layout($type)
    {
        if ($type) {
            Session::put('layout', $type);
            Session::save();
            return redirect()->back()->with('type', $type);
        } else {
            return redirect()->back();
        }
    }

    public function FormSubmit(Request $request)
    {
        return view('form-repeater');
    }

    public function setting(Request $request)
    {
        $path = $request->path();
        $path = explode('/',$path);
        $title = end($path);


        return view('pages.setting',[
            'title'=>$title
        ]);
    }

    public function patient(Request $request)
    {
        $path = $request->path();
        $path = explode('/',$path);
        $title = end($path);

        return view('pages.patient',[
            'title'=>$title
        ]);
    }

    public function patientEdit(Request $request,$patientID)
    {
        $path = $request->path();
        $path = explode('/',$path);
        $title = end($path);


        $check = \App\Models\IdentityPatient::where('patientID',$patientID)->where('identityID',auth()->user()->identity->id)->first();
        if(!$check){
            return abort(404);
        }

        return view('pages.patient',[
            'title'=>$title,
            'id'=>$patientID,
            'data'=>$check->patient
        ]);
    }

    public function patientStore(Request $request)
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
        $patient = \App\Models\Patient::create([
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

        \App\Models\IdentityPatient::create([
            'identityID'=>auth()->user()->identity->id,
            'patientID'=>$patient->id
        ]);


        return redirect()->route('setting')->with(['message'=>'Data Created Successfully']);
    }

    public function patientUpdate(Request $request,$id)
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

        return redirect()->route('setting')->with(['message'=>'Data Updated Successfully']);
    }

    public function settingAction(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'gender'=>'required'
        ]);

        if(auth()->user()->identity){
            // update
            \App\Models\Identity::where('id',auth()->user()->prefixID)->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'gender'=>$request->gender
            ]);
        }else{
            // create
            $identity = \App\Models\Identity::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'gender'=>$request->gender
            ]);

            \App\Models\User::where('id',auth()->user()->id)->update([
                'prefixID'=>$identity->id
            ]);
        }

        return redirect()->back()->with(['message'=>'Setting updated successfully']);
    }

    public function removeImage($path)
    {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}
