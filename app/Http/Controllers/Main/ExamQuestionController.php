<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ExamQuestion;
use App\Models\Exam;
use App\Models\SchoolYear;
use App\Models\Question;
use App\Http\Requests\StoreExamQuestionRequest;
use App\Http\Requests\UpdateExamQuestionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ExamQuestionController extends Controller
{

    // Display a listing of the ExamQuestion.
    public function index():View
    {
        $exam_questions= ExamQuestion::with('exam', 'question')->paginate(10);
        return view('dashboard.exams_questions.ExamQuestions',compact('exam_questions'));
    }

    /**
     * Show the form for creating a new ExamQuestion.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.exams_questions.AddExamQuestion',compact(['school_years']));
    }


    public function edit(Exam $exam, Question $question)
    {
        $examQuestion = $exam->questions()->where('question_id', $question->id)->first();
        $questions=Question::pluck('Question_name','id');
        $exams=Exam::pluck('exam_name','id');
        return view('dashboard.exams_questions.AddExamQuestion',compact('exam','exams','questions' ,'question', 'examQuestion'));
    }




    
}
