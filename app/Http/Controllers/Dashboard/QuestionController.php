<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;



class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects=Subject::all();
        $allQuestions=Question::paginate(10);
        return view('dashboard.questions.Question',compact(['subjects','allQuestions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects=Subject::pluck('subject_name','id');
        return view('dashboard.questions.AddQuestion',compact(['subjects']));
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
            "subject_id"=>"required",
            "question_name"=>"required",
        ]);
        Question::create($request->all());
        return back()->with('success', 'Question has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question=Question::find($id);
        if($question){

            return view('dashboard.questions.ShowQuestion',compact('question'));
        }
        return redirect()->route('questions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question=Question::find($id);
        $subjects=Subject::pluck('subject_name','id');

        return view('dashboard.questions.EditQuestion',compact('subjects','question'));

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
        $request->validate([
            "subject_id"=>"required",
            "question_name"=>"required",

        ]);
        $question=Question::find($id);
        $question->subject_id=$request->subject_id;
        $question->question_name=$request->question_name;
        $question->save();
        return back()->with('success', 'Question has been Updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question=Question::find($id);
        $question->delete();
        return redirect()->route('questions');
    }

    public function archived_questions()
    {
        $questions = Question::onlyTrashed()->get();

        return view('dashboard.questions.Deleted_questions',compact(['questions']));
    }

    public function restore($id)
    {
        $question=Question::withTrashed()->where('id',$id);
        $question->restore();
        return redirect()->route('questions');
    }
    public function hard_delete_question($id)
    {
        $question=Question::withTrashed()->where('id',$id);
        $question->forceDelete();
        return redirect()->route('questions');
    }

}


