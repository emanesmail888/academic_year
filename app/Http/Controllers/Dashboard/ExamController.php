<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $exams=Exam::paginate(10);
       return view('dashboard.exams.Exam',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.exams.AddExam');

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
            "exam_name"=>"required",
            "exam_date"=>"required",
        ]);
        Exam::create($request->all());
        return back()->with('success', 'Exam has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam=Exam::find($id);
        if($exam){

            return view('dashboard.exams.ShowExam',compact('exam'));
        }
        return redirect()->route('exams');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam=Exam::find($id);
        return view('dashboard.exams.EditExam',compact('exam'));

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
            "exam_name"=>"required",
            "exam_date"=>"required",
        ]);
        $exam=Exam::find($id);
        $exam->exam_name=$request->exam_name;
        $exam->exam_date=$request->exam_date ;
        $exam->save();
        return back()->with('success', 'Exam has been Updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam=exam::find($id);
        $exam->delete();
        return redirect()->route('exams');
    }

    public function archived_exams()
    {
        $exams = Exam::onlyTrashed()->get();

        return view('dashboard.exams.Deleted_exams',compact(['exams']));
    }

    public function restore($id)
    {
        $exam=exam::withTrashed()->where('id',$id);
        $exam->restore();
        return redirect()->route('exams');
    }
    public function hard_delete_exam($id)
    {
        $exam=Exam::withTrashed()->where('id',$id);
        $exam->forceDelete();
        return redirect()->route('exams');
    }



}
