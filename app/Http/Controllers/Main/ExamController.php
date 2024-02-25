<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\SchoolYear;
use App\Models\SchoolClass;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $subjects=Subject::cursor();
        $exams=Exam::paginate(10);
        return view('dashboard.exams.Exam',compact(['subjects','exams']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.exams.AddExam',compact(['school_years']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $exam = Exam::create($data);
        return back()->with('success', 'Exam has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam):View
    {
        return view('dashboard.exams.ShowExam',compact('exam'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam):View
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.exams.AddExam',compact(['exam','school_years']));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRequest $request, Exam $exam):RedirectResponse
    {
        $data = $request->validated();
        $data['exam_name']  = $request->exam_name;
        $data['exam_date']  = $request->exam_date;
        $data['subject_id']  = $request->subject_id;
        $exam->update($data);
        return back()->with('success', 'Exam has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam):RedirectResponse
    {
        $exam->delete();
        return redirect()->back()->with('success', 'Exam deleted successfully.');
    }


    //get all trashed Exams deleted with softDelete
    public function archived_exams():View
    {
        $deleted_exams = Exam::onlyTrashed()->paginate(10);
        return view('dashboard.exams.Exam',compact(['deleted_exams']));
    }

    //restore exams which deleted with softDelete 
    public function restore($id):RedirectResponse
    {
        $exam=Exam::withTrashed()->where('id',$id);
        $exam->restore();
        return redirect()->route('exams.index');
    }

    //deleting Exam completely
    public function hard_delete_exam($id):RedirectResponse
    {
        $exam=Exam::withTrashed()->where('id',$id);
        $exam->forceDelete();
        return redirect()->route('exams.index');
    }
}
