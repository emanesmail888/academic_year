<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use App\Http\Requests\StoreSchoolYearRequest;
use App\Http\Requests\UpdateSchoolYearRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;



class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
       $schoolYears=SchoolYear::paginate(10);
       return view('dashboard.school_years.SchoolYear',compact(['schoolYears']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.school_years.AddSchoolYear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSchoolYearRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolYearRequest $request):RedirectResponse
    {
        $data = $request->validated();
        $schoolYear = SchoolYear::create($data);
        return back()->with('success', 'SchoolYear has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolYear $schoolYear):View
    {
        return view('dashboard.school_years.ShowSchoolYear',compact('schoolYear'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolYear $schoolYear)
    {
        return view('dashboard.school_years.AddSchoolYear',compact(['schoolYear']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchoolYearRequest  $request
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolYearRequest $request, SchoolYear $schoolYear): RedirectResponse
    {
        $data = $request->validated();
        $data['year']  = $request->year;
        $schoolYear->update($data);
        return back()->with('success', 'SchoolYear has been Updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolYear $schoolYear): RedirectResponse
    {
        $schoolYear->delete();
        return redirect()->back()->with('success', 'SchoolYear deleted successfully.');
    }

    //get all trashed school years deleted with softDelete
    public function archived_school_years():View
    {
        $trashedYears = SchoolYear::onlyTrashed()->paginate(10);
        return view('dashboard.school_years.SchoolYear',compact(['trashedYears']));
    }

    //restore school years which deleted with softDelete 
    public function restore($id):RedirectResponse
    {
        $schoolYear=SchoolYear::withTrashed()->where('id',$id);
        $schoolYear->restore();
        return redirect()->route('school_years.index');
    }
    // deleting school year completely
    public function hard_delete_school_year($id):RedirectResponse
    {
        $schoolYear=SchoolYear::withTrashed()->where('id',$id);
        $schoolYear->forceDelete();
        return redirect()->route('school_years.index');
    }

}
