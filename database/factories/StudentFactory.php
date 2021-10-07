<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
             'last_name'=>$this->faker->lastname, 
             'date_of_birth'=>$this->faker->datetime(),
            'group_id' => Group::all()->random()->id

        ];
    }
}
