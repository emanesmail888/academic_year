<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolYear;
use App\Models\SchoolClass;


class SchoolClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $schoolYears=SchoolYear::all();
        $allSchoolClasses=SchoolClass::paginate(10);
        return view('dashboard.school_classes.SchoolClass',compact(['allSchoolClasses','schoolYears']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $school_years=SchoolYear::pluck('year','id');
      return view('dashboard.school_classes.AddSchoolClass',compact(['school_years']));


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
            "school_year_id"=>"required",
            "class_name"=>"required",
        ]);
        SchoolClass::create($request->all());
        return back()->with('success', 'SchoolClass has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schoolClass=SchoolClass::find($id);
        if($schoolClass){

            return view('dashboard.school_Classes.ShowSchoolClass',compact('schoolClass'));
        }
        return redirect()->route('school_Classes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schoolClass=SchoolClass::find($id);
        $school_years=SchoolYear::pluck('year','id');

        return view('dashboard.school_classes.EditSchoolClass',compact('schoolClass','school_years'));

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
            "school_year_id"=>"required",
            "class_name"=>"required",

        ]);
        $schoolClass=SchoolClass::find($id);
        $schoolClass->school_year_id=$request->school_year_id;
        $schoolClass->class_name=$request->class_name;
        $schoolClass->save();
        return back()->with('success', 'SchoolClass has been Updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schoolClass=SchoolClass::find($id);
        $schoolClass->delete();
        return redirect()->route('school_classes');
    }

    public function archived_school_classes()
    {
        $schoolClasses = SchoolClass::onlyTrashed()->get();

        return view('dashboard.school_classes.Deleted_school_classes',compact(['schoolClasses']));
    }

    public function restore($id)
    {
        $schoolClass=SchoolClass::withTrashed()->where('id',$id);
        $schoolClass->restore();
        return redirect()->route('school_classes');
    }
    public function hard_delete_school_class($id)
    {
        $schoolClass=SchoolClass::withTrashed()->where('id',$id);
        $schoolClass->forceDelete();
        return redirect()->route('school_classes');
    }

}
