<?php

namespace Database\Factories;

use App\Models\Cycle;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this-> faker->randomElement(['Grupo 1', 'Grupo 2','Grupo 3']),
            'cycle_id' => Cycle::all()->random()->id
        ];
    }
}
