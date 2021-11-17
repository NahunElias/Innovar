<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coment_entrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'mensaje',
        'identrega',
        'idmaestro',
    ];

}
