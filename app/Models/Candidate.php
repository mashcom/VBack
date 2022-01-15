<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    public function getNationalIdAttribute($value)
    {
        $national_id = str_replace("-","",$value);
        return str_replace("","",$national_id);

    }

    public function election()
    {
        return $this->belongsTo('App\Models\Election');
    }

    public function party()
    {
        return $this->belongsTo('App\Models\Party');
    }

    public function portfolio()
    {
        return $this->belongsTo('App\Models\Portfolio');
    }

}
