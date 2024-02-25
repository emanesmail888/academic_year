<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
        return [
            "subject_id" => "required|exists:subjects,id",
            "question_name" => "required|string ",
            'answers' => 'required|array',
            // 'answers[][answer_text]' => 'required|string',
            // 'answers[][correct_answer]' => 'nullable|boolean',


        ];
    }
}
