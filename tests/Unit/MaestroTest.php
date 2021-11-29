<?php

namespace Tests\Unit;

use App\Models\Maestro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Tests\TestCase;

class MaestroTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_maestro_tiene_asignaturas()
    {
        $maestro = new Maestro();

        $this->assertInstanceOf(SupportCollection::class, $maestro->asignaturas);
    }
}
