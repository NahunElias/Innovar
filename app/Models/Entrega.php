<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'archivo',
        'descripcion',
        'calificacion',
        'estatu',
        'idalumno',
        'idtarea',
    ];

}
