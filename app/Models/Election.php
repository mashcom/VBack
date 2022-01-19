<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    public function candidates(){
        return $this->hasMany(Candidate::class,"election_id","id");
    }
    public function getNameAttribute($value){
        return strtoupper($value);
    }
}
