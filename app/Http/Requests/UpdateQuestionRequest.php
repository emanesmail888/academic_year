<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            "subject_id" => "required|exists:subjects,id",
            "question_name" => "required|string",
            'answers' => 'required|array',

        ];

        $answers = $this->input('answers', []);
        foreach ($answers as $index => $answer) {
            $rules['answers.' . $index . '.answer_text'] = 'required|string';
            $rules['answers.' . $index . '.correct_answer'] = 'boolean';
            $rules['answers.' . $index . '.id'] = 'required';
           
        }
        return $rules;

    }
}
