<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'are_id',
        'teacher_id',
    ];
    
    public function Area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function Teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }
}
