<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Exam;
use App\Models\Subject;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Exam::class;

    public function definition()
    {
        return [
            'exam_name' => $this->faker->sentence,
            'exam_date' => $this->faker->date,
            'subject_id' => function () {
                return Subject::pluck('id')->random();
            },

        ];
    }
}
