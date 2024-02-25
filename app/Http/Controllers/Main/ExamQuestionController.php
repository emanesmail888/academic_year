<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ExamQuestion;
use App\Models\Exam;
use App\Models\SchoolYear;
use App\Models\Question;
use App\Http\Requests\StoreExamQuestionRequest;
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

    //Show the form for creating a new ExamQuestion.
    public function create():View
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.exams_questions.AddExamQuestion',compact(['school_years']));
    }

   //store Exam and Question For Specific subject
    public function store(StoreExamQuestionRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $exam_question = ExamQuestion::create($data);
        return back()->with('success', 'Exam And Question has been created successfully');
    }

    //delete Exam And Questions Associated with it
    public function delete_exam_question($examId,$questionId):RedirectResponse
    {
        $exam = Exam::findOrFail($examId);
        $question = Question::findOrFail($questionId);
        $exam->questions()->detach($question);
        return redirect()->route('exam_questions.index');
    }


    //get Questions And Exams Associated With Subject
    public function selectExamQuestion(Request $request):JsonResponse
    {
        $subjectId = $request->input('subject_id');

        // Retrieve the questions and exams  based on the subject_id
        $questions= DB::table('questions')
                            ->where('subject_id', $subjectId)
                            ->get();
        $exams= DB::table('exams')
                            ->where('subject_id', $subjectId)
                            ->get();

        // Generate the select option in html question_id
        $questions_options = '<option value="">Select a question</option>';
        foreach ($questions as $question) {
            $questions_options .= '<option value="'.$question->id.'">'.$question->question_name.'</option>';
        }
        // Generate the select option in html exam_id
        $exams_options = '<option value="">Select a exam</option>';
        foreach ($exams as $exam) {
            $exams_options .= '<option value="'.$exam->id.'">'.$exam->exam_name.'</option>';
        }

        // Return the select option  as a response in html
        return response()->json(['questions_options'=>$questions_options,'exams_options'=>$exams_options]);
    }



   

    
}
