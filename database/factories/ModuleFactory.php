<?php

namespace Database\Factories;

use App\Models\Cycle;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Module::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this-> faker->randomElement(['Modulo 1', 'Modulo 2','Modulo 3']),
            'cycle_id' => Cycle::all()->random()->id
        ];
    }
}
