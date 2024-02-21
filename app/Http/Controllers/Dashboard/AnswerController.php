<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Questions=Question::all();
        $allAnswers=Answer::paginate(10);
        return view('dashboard.answers.Answer',compact(['Questions','allAnswers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions=Question::pluck('Question_name','id');
        return view('dashboard.answers.AddAnswer',compact(['questions']));
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
            "question_id"=>"required",
            "answer_text"=>"required",
            "correct_answer"=>"required|boolean",
        ]);
        $exists = Answer::where([
            'question_id' => $request->question_id,
            'correct_answer' => 1,
        ])->exists();

        if ($exists) {
            $answer=new Answer();
            $answer->question_id=$request->question_id;
            $answer->answer_text=$request->answer_text;
            if($request->correct_answer==1)
            {
                return back()->with('Fail', 'This Question Has Already Answer True');
            }
            else{
                $answer->correct_answer=$request->correct_answer;
                $answer->save();
                return back()->with('success', 'Answer has been created successfully');

            }
        }
        else{
        Answer::create($request->all());
        return back()->with('success', 'Answer has been created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer=answer::find($id);
        if($answer){

            return view('dashboard.answers.ShowAnswer',compact('answer'));
        }
        return redirect()->route('answers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer=Answer::find($id);
        $questions=Question::pluck('Question_name','id');

        return view('dashboard.answers.EditAnswer',compact('questions','answer'));

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
            "question_id"=>"required",
            "answer_text"=>"required",
            "correct_answer"=>"required|boolean",

        ]);
        $exists = Answer::where([
            'question_id' => $request->question_id,
            'correct_answer' => 1,
        ])->exists();

        if ($exists) {
            $answer=Answer::find($id);
            $answer->question_id=$request->question_id;
            $answer->answer_text=$request->answer_text;
            if($request->correct_answer==1)
            {
                return back()->with('Fail', 'This Question Has Already Answer True');
            }
            else{
                $answer->correct_answer=$request->correct_answer;
                $answer->save();
                return back()->with('success', 'Answer has been Updated successfully');

            }
        }
        else{
        $answer=Answer::find($id);
        $answer->question_id=$request->question_id;
        $answer->answer_text=$request->answer_text;
        $answer->correct_answer=$request->correct_answer;
        $answer->save();
        return back()->with('success', 'Answer has been Updated successfully');
         }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer=Answer::find($id);
        $answer->delete();
        return redirect()->route('answers');
    }
    public function archived_answers()
    {
        $answers = Answer::onlyTrashed()->get();

        return view('dashboard.answers.Deleted_answers',compact(['answers']));
    }

    public function restore($id)
    {
        $answer=Answer::withTrashed()->where('id',$id);
        $answer->restore();
        return redirect()->route('answers');
    }
    public function hard_delete_answer($id)
    {
        $answer=Exam::withTrashed()->where('id',$id);
        $answer->forceDelete();
        return redirect()->route('answers');
    }



}









