<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;



class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $schoolClasses=SchoolClass::cursor();
        $subjects=Subject::paginate(10);
        return view('dashboard.subjects.Subject',compact(['schoolClasses','subjects']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.subjects.AddSubject',compact(['school_years']));
    }

public function selectSchoolClass(Request $request):JsonResponse
  {
    $schoolYearId = $request->input('school_year_id');

    // Retrieve the school classes based on the school_year_id
    $schoolClasses = DB::table('school_classes')
                        ->where('school_year_id', $schoolYearId)
                        ->get();

    // Generate the select option in html
    $options = '<option value="">Select a school class</option>';
    foreach ($schoolClasses as $class) {
        $options .= '<option value="'.$class->id.'">'.$class->class_name.'</option>';
    }

    // Return the select option  as a response in html
    return response()->json($options);
}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $subject = Subject::create($data);
        return back()->with('success', 'Subject has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject):View
    {
        return view('dashboard.subjects.ShowSubject',compact('subject'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject):View
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.subjects.AddSubject',compact(['subject','school_years']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject):RedirectResponse
    {
        $data = $request->validated();
        $data['subject_name']  = $request->subject_name;
        $data['school_class_id']  = $request->school_class_id;
        $subject->update($data);
        return back()->with('success', 'Subject has been Updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject):RedirectResponse
    {
        $subject->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully.');
    }

    //get all trashed subjects deleted with softDelete
    public function archived_subjects()
    {
        $deleted_subjects = Subject::onlyTrashed()->paginate(10);
        return view('dashboard.subjects.Subject',compact(['deleted_subjects']));
    }

    //restore subjects which deleted with softDelete
    public function restore($id):RedirectResponse
    {
        $subject=Subject::withTrashed()->where('id',$id);
        $subject->restore();
        return redirect()->route('subjects.index');
    }
    

    //hard delete subject
    public function hard_delete_subject($id):RedirectResponse
    {
        $subject=Subject::withTrashed()->where('id',$id);
        $subject->forceDelete();
        return redirect()->route('subjects.index');
    }

}

