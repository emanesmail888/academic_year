<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;
use App\Models\Answer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Answer::class;

    public function definition()
    {
        $question_id = Question::pluck('id')->random();
        $exists = Answer::where([
            'question_id' => $question_id,
            'correct_answer' => 1,
        ])->exists();

        if ($exists) {
            return [
                'question_id' => $question_id,
                'answer_text' => $this->faker->sentence,
                'correct_answer' => false,
            ];
        }

        return [
            'question_id' => function () {
                return Question::pluck('id')->random();
            },
            'answer_text' => $this->faker->sentence,
            'correct_answer' => $this->faker->boolean,
        ];
    }
}
