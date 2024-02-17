<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Question;
use App\Models\subject;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Question::class;

    public function definition()
    {

        return [
            'question_name' => $this->faker->sentence,
            'answers' =>json_encode([
                $this->faker->word,
                $this->faker->word,
                $this->faker->word]),
            'correct_answer' => $this->faker->numberBetween(0, 2),
            'subject_id' => function () {
                return Subject::pluck('id')->random();
            },
        ];
    }
}
