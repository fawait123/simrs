<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    protected $with = ['patient','user','doctor'];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patientID');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctorID');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'userID');
    }
}
