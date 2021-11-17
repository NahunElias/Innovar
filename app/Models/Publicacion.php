<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'idmaestro',
        'idalumno_clase',
        'idtipo',
    ];

    public function archivos()
    {
        return $this->hasMany('App\Models\Archivo');
    }

}
