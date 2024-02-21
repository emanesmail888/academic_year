<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ExamQuestion;
use App\Models\Exam;
use App\Models\Question;

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
    public function create()
    {
        $questions=Question::pluck('Question_name','id');
        $exams=Exam::pluck('exam_name','id');
        return view('dashboard.exams_questions.AddExamQuestion',compact(['questions','exams']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "exam_id"=>"required",
            "question_id"=>"required",
        ]);
        ExamQuestion::create($request->all());
        return back()->with('success', 'Exam_question has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam_question=ExamQuestion::find($id);
        if($exam_question){

            return view('dashboard.exams.ShowExamQuestion',compact('exam_question'));
        }
        return redirect()->route('exams_questions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam, Question $question)
    {
        $examQuestion = $exam->questions()->where('question_id', $question->id)->first();
        $questions=Question::pluck('Question_name','id');
        $exams=Exam::pluck('exam_name','id');
        return view('dashboard.exams_questions.EditExamQuestion',compact('exam','exams','questions' ,'question', 'examQuestion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Exam $exam, Question $question)
    {
        $this->validate($request,[
                    "exam_id"=>"required",
                    "question_id"=>"required",
                ]);

        $pivotData = [
            'exam_id' => $request->exam_id,
            'question_id' => $request->question_id,
        ];
        $exam->questions()->updateExistingPivot($question->id, $pivotData);
        return back()->with('success', 'ExamQuestion has been Updated successfully');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($exam,$question)
    {
        $exam = Exam::find($exam);
        $exam->questions()->detach($question);
        // $exam->questions()->delete();
        return back()->with('success', 'Pivot ExamClass has been deleted successfully');
    }

    // public function del_exams_questions()
    // {
    //     $exams_questions = DB::table('exam_question')
    //     ->whereNotNull('deleted_at')
    //     ->get();
    //     return view('dashboard.exams_questions.Deleted_exams_questions',compact(['exams_questions']));
    // }




}
