<?php

namespace Database\Factories;

use App\Models\Cycle;
use Illuminate\Database\Eloquent\Factories\Factory;

class CycleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cycle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->randomElement(['ciclo 1','ciclo 2','ciclo 3','ciclo 4','ciclo 5','ciclo 6']),
            'description'=>$this->faker->paragraph(),
            'duration'=>$this->faker->randomDigit()
        ];
    }
}
