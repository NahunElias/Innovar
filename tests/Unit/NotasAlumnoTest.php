<?php

namespace Tests\Unit;

use App\Models\Alumno;
use App\Models\Calificacion;
use App\Models\Maestro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Tests\TestCase;

class NotasAlumnoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_calificacion_tiene_alumno()
    {
        $calificacion = new Calificacion();

        $this->assertInstanceOf(SupportCollection::class, $calificacion->alumno);
    }
}
