<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamQuestion;

class ExamQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam_questions=ExamQuestion::all();
       return view('dashboard.exams_questions.ExamQuestions',compact('exam_questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.exams_questions.AddExam_question');

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
    public function edit($id)
    {
        $exam_question=ExamQuestion::find($id);
        return view('dashboard.exams_questions.EditExamQuestion',compact('exam_question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            "exam_id"=>"required",
            "question_id"=>"required",
        ]);
        $exam_question=ExamQuestion::find($id);
        $exam_question->exam_id=$request->exam_id;
        $exam_question->question_id=$request->question_id ;
        $exam_question->save();
        return back()->with('success', 'ExamQuestion has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam_question=exam::find($id);
        $exam_question->delete();
        return redirect()->route('exams_questions');
    }

    public function archived_exams()
    {
        $exams_questions = ExamQuestion::onlyTrashed()->get();

        return view('dashboard.exams_questions.Deleted_exams_questions',compact(['exams_questions']));
    }

    public function restore($id)
    {
        $exam_question=ExamQuestion::withTrashed()->where('id',$id);
        $exam_question->restore();
        return redirect()->route('exams_questions');
    }
    public function hard_delete_exam_question($id)
    {
        $exam_question=ExamQuestion::withTrashed()->where('id',$id);
        $exam_question->forceDelete();
        return redirect()->route('exams_questions');
    }


}
