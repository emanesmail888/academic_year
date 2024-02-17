<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SchoolYear;


class indexController extends Controller
{
    public function index(Request $request)
    {
        $school_years = DB::table('school_years')->count();
        $school_classes = DB::table('school_classes')->count();
        $subjects = DB::table('subjects')->count();
        $classes_per_year = DB::table('school_classes')->leftJoin('school_years', 'school_classes.school_year_id', '=', 'school_years.id')->get();
        $schoolClassesInYear = SchoolYear::withCount('schoolClasses')->get();
        $subjectsWithYear = SchoolYear::yearWithSubjects()->get();
        $examsWithYear = SchoolYear::yearWithExams()->get();




        return view('index',compact(['school_years','school_classes','classes_per_year','subjects','subjectsWithYear','examsWithYear','schoolClassesInYear']));
    }


}