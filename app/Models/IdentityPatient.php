<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentityPatient extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['patient'];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patientID');
    }
}
