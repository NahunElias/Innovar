<?php

namespace Tests\Unit;

use App\Models\Examen;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Tests\TestCase;

class ExamenAlumnoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_examen_tiene_alumno()
    {
        $examen = new Examen();

        $this->assertInstanceOf(SupportCollection::class, $examen->alumno);
    }
}
