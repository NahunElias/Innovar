<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
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

    public function respuestas()
    {
        return  $this->belongsToMany('App\Models\Respuesta');
    }

    public function Foro_mensaje()
    {
        return $this->morphOne('App\Models\Foro_mensaje','mensajeable_type');
    }

    public function users()
    {
        return $this->hasMany('User', 'iduser');
    }

}
