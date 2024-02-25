<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SchoolYear;
use App\Models\Question;
use App\Models\ExamQuestion;


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
        // $examsWithYear = SchoolYear::getYearsWithExams()->get();

        $examsWithYear = DB::table('school_years')
        ->join('school_classes', 'school_years.id', '=', 'school_classes.school_year_id')
        ->join('subjects', 'school_classes.id', '=', 'subjects.school_class_id')
        ->join('exams', 'subject_id', '=', 'exams.subject_id')
        ->select('school_years.year')
        ->groupBy('school_years.year')
        ->get();
       
        return view('index',compact(['school_years','school_classes','classes_per_year','subjects','subjectsWithYear','schoolClassesInYear','examsWithYear']));
    }







}
