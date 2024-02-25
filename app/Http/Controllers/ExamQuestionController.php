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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam_questions= ExamQuestion::with('exam', 'question')->paginate(10);
        return view('dashboard.exams_questions.ExamQuestions',compact('exam_questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.exams_questions.AddExamQuestion',compact(['school_years']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamQuestionRequest $request)
    {
        $data = $request->validated();
        $exam_question = ExamQuestion::create($data);
        return back()->with('success', 'Exam And Question has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamQuestion  $examQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(ExamQuestion $examQuestion)
    {
        return view('dashboard.exams_questions.ShowExamQuestion',compact('examQuestion'));

    }

   
    public function edit(ExamQuestion $examQuestion)
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.exams_questions.AddExamQuestion',compact(['examQuestion','school_years']));
    }

    // public function edit(Exam $exam, Question $question)
    // {   
    //     $school_years=SchoolYear::cursor();
    //     $examQuestion = $exam->questions()->where('question_id', $question->id)->first();
    //     $questions=Question::pluck('Question_name','id');
    //     $exams=Exam::pluck('exam_name','id');
    //     return view('dashboard.exams_questions.AddExamQuestion',compact('exam','exams','questions' ,'question', 'examQuestion','school_years'));
    // }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamQuestionRequest  $request
     * @param  \App\Models\ExamQuestion  $examQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamQuestionRequest $request, ExamQuestion $examQuestion)
    {
        $data = $request->validated();
        // Update the Exam Question
        $question->update([
            'question_id' => $data['question_id'],
            'exam_id' => $data['exam_id'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamQuestion  $examQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamQuestion $examQuestion)
    {
        $exam = Exam::findOrFail($examQuestion->exam_id);
        $exam->questions()->detach($question);
        return back()->with('success', 'Pivot ExamClass has been deleted successfully');
    }


    public function selectExamQuestion(Request $request):JsonResponse
{
    $subjectId = $request->input('subject_id');

    // Retrieve the questions  based on the subject_id
    $questions= DB::table('questions')
                        ->where('subject_id', $subjectId)
                        ->get();
    // Retrieve the exams  based on the subject_id
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
