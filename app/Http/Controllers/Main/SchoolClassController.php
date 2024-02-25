<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $schoolYears=SchoolYear::cursor();
        $schoolClasses=SchoolClass::paginate(10);
        return view('dashboard.school_classes.SchoolClass',compact(['schoolClasses','schoolYears']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
      $school_years=SchoolYear::cursor();
      return view('dashboard.school_classes.AddSchoolClass',compact(['school_years']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSchoolClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolClassRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $schoolClass = SchoolClass::create($data);
        return back()->with('success', 'SchoolClass has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolClass  $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolClass $schoolClass):View
    {
        return view('dashboard.school_classes.ShowSchoolClass',compact('schoolClass'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolClass  $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolClass $schoolClass):View
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.school_classes.AddSchoolClass',compact(['schoolClass','school_years']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchoolClassRequest  $request
     * @param  \App\Models\SchoolClass  $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolClassRequest $request, SchoolClass $schoolClass): RedirectResponse
    {
        $data = $request->validated();
        $data['class_name']  = $request->class_name;
        $data['school_year_id']  = $request->school_year_id;
        $schoolClass->update($data);
        return back()->with('success', 'SchoolClass has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolClass  $schoolClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolClass $schoolClass):RedirectResponse
    {
        $schoolClass->delete();
        return redirect()->back()->with('success', 'SchoolClass deleted successfully.');
    }

    public function archived_school_classes():View
    {
        $trashedClasses = SchoolClass::onlyTrashed()->paginate(10);
        return view('dashboard.school_classes.SchoolClass',compact(['trashedClasses']));
    }

    public function restore($id):RedirectResponse
    {
        $schoolClass=SchoolClass::withTrashed()->where('id',$id);
        $schoolClass->restore();
        return redirect()->route('school_classes.index');
    }
    public function hard_delete_school_class($id):RedirectResponse
    {
        $schoolClass=SchoolClass::withTrashed()->where('id',$id);
        $schoolClass->forceDelete();
        return redirect()->route('school_classes.index');
    }

}

