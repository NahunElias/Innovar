<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    public function Activity(){
        return $this->belongsTo('App\Models\Activity');
    }

    public function materia()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    protected $fillable = [
        'name',
        'observation',
        'note',
        'date',
        'subject_id',
    ];

    
    
    
}
