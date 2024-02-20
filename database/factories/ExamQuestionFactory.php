<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\Exam;
use App\Models\Subject;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamQuestion>
 */
class ExamQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ExamQuestion::class;

    public function definition()
    {
        return [
            'exam_id' => function () {
                return Exam::pluck('id')->random();
            },
            'question_id' => function () {
                return Question::pluck('id')->random();
            },
            
        ];
    }
}
