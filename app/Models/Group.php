<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function Cycle(){
        return $this->belongsTo('App\Models\Cycle');
    }

    public function Student(){
        return $this->belongsTo('App\Models\Student');
    }
}
