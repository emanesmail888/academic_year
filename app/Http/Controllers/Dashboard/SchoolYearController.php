<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolYear;



class SchoolYearController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $allSchoolYears=SchoolYear::paginate(10);
       return view('dashboard.school_years.SchoolYear',compact(['allSchoolYears']));

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "year"=>"required|numeric|between:2015,2040",
        ]);
        SchoolYear::create($request->all());
        return back()->with('success', 'SchoolYear has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schoolYear=SchoolYear::find($id);
        if($schoolYear){

            return view('dashboard.school_years.ShowSchoolYear',compact('schoolYear'));
        }
        return redirect()->route('school_years');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schoolYear=SchoolYear::find($id);
        return view('dashboard.school_years.EditSchoolYear',compact('schoolYear'));

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
            "year"=>"required|numeric|between:2015,2040",
        ]);
        $schoolYear=SchoolYear::find($id);
        $schoolYear->year=$request->year;
        $schoolYear->save();
        return back()->with('success', 'SchoolYear has been Updated successfully');

    }

    public function archived_school_years()
    {
        $schoolYears = SchoolYear::onlyTrashed()->get();

        return view('dashboard.school_years.Deleted_school_years',compact(['schoolYears']));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schoolYear=SchoolYear::find($id);
        $schoolYear->delete();
        return redirect()->route('school_years');
    }

    public function restore($id)
    {
        $schoolYear=SchoolYear::withTrashed()->where('id',$id);
        $schoolYear->restore();
        return redirect()->route('school_years');
    }
    public function hard_delete_school_year($id)
    {
        $schoolYear=SchoolYear::withTrashed()->where('id',$id);
        $schoolYear->forceDelete();
        return redirect()->route('school_years');
    }


}
