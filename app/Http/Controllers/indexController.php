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
        $examsWithYear = SchoolYear::getYearsWithExams()->get();
        $examsWithYear1 = DB::table('school_years')
        ->join('school_classes', 'school_years.id', '=', 'school_classes.school_year_id')
        ->join('subjects', 'school_classes.id', '=', 'subjects.school_class_id')
        ->join('questions', 'subjects.id', '=', 'questions.subject_id')
        ->join('exam_question', 'questions.id', '=', 'exam_question.question_id')
        ->join('exams', 'exam_question.exam_id', '=', 'exams.id')
        ->select('school_years.year')
        ->groupBy('school_years.year')
        ->get();
        // $result = DB::table('school_years')
        // ->crossJoin('exam_question')
        // ->select('school_years.year', 'exam_question.exam_id')
        //  ->get();

        return view('index',compact(['school_years','school_classes','classes_per_year','subjects','subjectsWithYear','schoolClassesInYear','examsWithYear','examsWithYear1']));
    }







}
