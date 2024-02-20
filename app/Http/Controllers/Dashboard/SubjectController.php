<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Subject;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolClasses=SchoolClass::all();
        $allSubjects=Subject::paginate(10);
        return view('dashboard.subjects.Subject',compact(['allSubjects','schoolClasses']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school_classes=SchoolClass::pluck('class_name','id');
        return view('dashboard.subjects.AddSubject',compact(['school_classes']));
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
            "school_class_id"=>"required",
            "subject_name"=>"required",
        ]);
        Subject::create($request->all());
        return back()->with('success', 'Subject has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject=Subject::find($id);
        if($subject){

            return view('dashboard.subjects.ShowSubject',compact('subject'));
        }
        return redirect()->route('subjects');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject=Subject::find($id);
        $schoolClasses=SchoolClass::pluck('class_name','id');

        return view('dashboard.subjects.EditSubject',compact('schoolClasses','subject'));

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
            "school_class_id"=>"required",
            "subject_name"=>"required",

        ]);
        $subject=Subject::find($id);
        $subject->school_class_id=$request->school_class_id;
        $subject->subject_name=$request->subject_name;
        $subject->save();
        return back()->with('success', 'Subject has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject=Subject::find($id);
        $subject->delete();
        return redirect()->route('subjects');
    }
    public function archived_subjects()
    {
        $subjects = Subject::onlyTrashed()->get();

        return view('dashboard.subjects.Deleted_subjects',compact(['subjects']));
    }

    public function restore($id)
    {
        $subject=Subject::withTrashed()->where('id',$id);
        $subject->restore();
        return redirect()->route('subjects');
    }
    public function hard_delete_subject($id)
    {
        $subject=Subject::withTrashed()->where('id',$id);
        $subject->forceDelete();
        return redirect()->route('subjects');
    }

}
