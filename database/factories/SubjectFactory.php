<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subject;
use App\Models\SchoolClass;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Subject::class;

    public function definition()
    {
        return [
            'school_class_id' => function () {
                return SchoolClass::pluck('id')->random();
            },
            'subject_name' => $this->faker->word,
        ];
    }
}
