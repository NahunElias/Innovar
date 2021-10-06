<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    public function Module(){
        return $this->hasMany('App\Models\Module');
    }

    public function Group(){
        return $this->hasMany('App\Models\Group');
    }
}
