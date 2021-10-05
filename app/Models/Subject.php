<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function Area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function Teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }
}
