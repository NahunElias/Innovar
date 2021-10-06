<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public function Teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }

    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function Document(){
        return $this->belongsTo('App\Models\Document');
    }

    public function Qualification(){
        return $this->hasMany('App\Models\Qualification');
    }
}
