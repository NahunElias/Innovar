<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Qualification;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'description'=>$this->faker->lastname,
            'start_date'=>$this->faker->datetime(),
            'end_date'=>$this->faker->datetime(),
            'state'=>$this->faker->sentence(),
            'category_id' => Category::all()->random()->id,
            'teacher_id' => Teacher::all()->random()->id,
            'qualification' => Qualification::all()->random()->id

            
        ];
    }
}
