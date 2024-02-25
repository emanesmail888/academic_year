<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Main\SchoolYearController;
use App\Http\Controllers\Main\SchoolClassController;
use App\Http\Controllers\Main\SubjectController;
use App\Http\Controllers\Main\QuestionController;
use App\Http\Controllers\Main\ExamController;
use App\Http\Controllers\Main\ExamQuestionController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\HomeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();
Route::get('/', [indexController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'App\Http\Controllers\Main'], function () {
Route::resource('school_years', 'SchoolYearController');
Route::get('/school_year/archived',[SchoolYearController::class,'archived_school_years'])->name('school_years.archived');
Route::get('/school_year/restore/{id}',[SchoolYearController::class,'restore'])->name('school_year.restore');
Route::get('/school_year/hDelete/{id}',[SchoolYearController::class,'hard_delete_school_year'])->name('school_year.hard_delete');

Route::resource('school_classes', 'SchoolClassController');
Route::get('/school_class/archived',[SchoolClassController::class,'archived_school_classes'])->name('school_classes.archived');
Route::get('/school_class/restore/{id}',[SchoolClassController::class,'restore'])->name('school_class.restore');
Route::get('/school_class/hDelete/{id}',[SchoolClassController::class,'hard_delete_school_class'])->name('school_class.hard_delete');

Route::resource('subjects', 'SubjectController');
Route::get('select_school_class',[SubjectController::class,'selectSchoolClass'])->name('select_school_class');
Route::get('/subject/archived',[SubjectController::class,'archived_subjects'])->name('subject.archived');
Route::get('/subjects/restore/{id}',[SubjectController::class,'restore'])->name('subject.restore');
Route::get('/subjects/hDelete/{id}',[SubjectController::class,'hard_delete_subject'])->name('subject.hard_delete');

Route::resource('questions', 'QuestionController');
Route::get('/question/archived',[questionController::class,'archived_questions'])->name('question.archived');
Route::get('/question/restore/{id}',[questionController::class,'restore'])->name('question.restore');
Route::get('/question/hDelete/{id}',[questionController::class,'hard_delete_question'])->name('question.hard_delete');
Route::get('select_subject',[questionController::class,'selectSubject'])->name('select_subject');

Route::resource('exams', 'ExamController');
Route::get('/exam/archived',[ExamController::class,'archived_exams'])->name('exam.archived');
Route::get('/exam/restore/{id}',[ExamController::class,'restore'])->name('exam.restore');
Route::get('/exam/hDelete/{id}',[ExamController::class,'hard_delete_exam'])->name('exam.hard_delete');

Route::get('/exam_questions',[ExamQuestionController::class,'index'])->name('exam_questions.index');
Route::get('/exam_questions/create',[ExamQuestionController::class,'create'])->name('exam_questions.create');
Route::post('/exam_questions/store',[ExamQuestionController::class,'store'])->name('exam_questions.store');
Route::delete('/exam/{examId}/question/{questionId}',[ExamQuestionController::class,'delete_exam_question'])->name('exam_questions.delete');
Route::get('select_examQuestion',[ExamQuestionController::class,'selectExamQuestion'])->name('select_examQuestion');



});







