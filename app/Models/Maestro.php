<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'primer_nom',
        'segundo_nom',
        'apellido_p',
        'apellido_m',
        'direccion',
        'telefono',
        'iduser',
    ];

    public function asignaturas()
    {
        return  $this->belongsToMany('App\Models\Asignatura');
    }

    public function Foro_mensaje()
    {
        return $this->morphOne('App\Models\Foro_mensaje','mensajeable_type');
    }


}
