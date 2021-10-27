<?php

namespace Database\Factories;

use App\Models\assigments;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class assigmentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          
            
            'subjectId'=>Subject::all()->random()->id,
            'teacherId'=> Teacher::all()->random()->id,
            'AssignTitle'=>$this->faker->randomElement(),
            'AssignDescription'=>$this->faker->randomElement(),
            'AssignFile'=>$this->faker->randomElement(),
            'AssignDeadLine'=>$this->faker->randomElement(),
        ];
    }
}
