<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Identity extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    protected $with = ['patients'];

    public function patients()
    {
        return $this->hasMany(IdentityPatient::class,'identityID');
    }
}
