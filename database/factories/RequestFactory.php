<?php

namespace Database\Factories;

use App\Models\Request;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date'=>$this->faker->datetime(),
            'last_year_studied'=>$this->faker->datetime(),
            'student_id' => Student::all()->random()->id

        

        ];
    }
}
