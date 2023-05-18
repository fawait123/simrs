<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    protected $with = ['specialist'];


    public function specialist()
    {
        return $this->belongsTo(Specialist::class,'specialistID');
    }
}
