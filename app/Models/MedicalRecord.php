<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctorID');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patientID');
    }
}

