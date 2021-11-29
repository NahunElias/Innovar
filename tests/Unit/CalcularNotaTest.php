<?php

namespace Tests\Unit;

use App\Http\Controllers\EvaluacionAlumnoController;
use App\Models\Alumno;
use App\Models\Calificacion;
use App\Models\Maestro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Tests\TestCase;

class CalcularNotaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_calcular_notas()
    {
        $evaluacion = new EvaluacionAlumnoController();

        $notaNueva = $evaluacion->calcularNota(4, 4, 4, 4);

        $excepte = 4;

        $this->assertEquals($excepte, $notaNueva);
    }
}
