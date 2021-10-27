<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(),
            'area_id'=>Area::all()->random()->id,
            'teacher_id'=>Teacher::all()->random()->id
        ];
    }
}
