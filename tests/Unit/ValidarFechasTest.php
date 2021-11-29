<?php

namespace Tests\Unit;

use App\Http\Controllers\EvaluacionAlumnoController;
use App\Models\Alumno;
use App\Models\Calificacion;
use App\Models\Maestro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Tests\TestCase;

class ValidarFechasTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_validar_fechas()
    {
        $evaluacion = new EvaluacionAlumnoController();

        $validaFecha = $evaluacion->validar_rango('2019-01-27', '2019-01-27', '2019-01-27');

        $excepte = 0;

        $this->assertEquals($excepte, $validaFecha);
    }
}
