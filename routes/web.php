<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Main\SchoolYearController;
use App\Http\Controllers\Main\SchoolClassController;
use App\Http\Controllers\Main\SubjectController;
use App\Http\Controllers\Main\QuestionController;
use App\Http\Controllers\Main\ExamController;
use App\Http\Controllers\Dashboard\AnswerController;
// use App\Http\Controllers\Dashboard\ExamController;
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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();
Route::get('/', [indexController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/question/create',[questionController::class,'create'])->name('question.create');
// Route::post('/question/store',[questionController::class,'store'])->name('question.store');
// Route::get('/question/{id}',[questionController::class,'show'])->name('question.show');
// Route::get('/questions',[questionController::class,'index'])->name('questions');
// Route::get('/question/{id}/edit',[questionController::class,'edit'])->name('question.edit');
// Route::post('/question/{id}',[questionController::class,'update'])->name('question.update');
// Route::get('/question/{id}/delete',[questionController::class,'destroy'])->name('question.delete');
// Route::get('/questions/archived',[questionController::class,'archived_questions'])->name('questions.archived');
// Route::get('/questions/restore/{id}',[questionController::class,'restore'])->name('question.restore');
// Route::get('/questions/hDelete/{id}',[questionController::class,'hard_delete_question'])->name('question.hard_delete');



Route::get('/answer/create',[AnswerController::class,'create'])->name('answer.create');
Route::post('/answer/store',[AnswerController::class,'store'])->name('answer.store');
Route::get('/answer/{id}',[AnswerController::class,'show'])->name('answer.show');
Route::get('/answers',[AnswerController::class,'index'])->name('answers');
Route::get('/answer/{id}/edit',[AnswerController::class,'edit'])->name('answer.edit');
Route::post('/answer/{id}',[AnswerController::class,'update'])->name('answer.update');
Route::get('/answer/{id}/delete',[AnswerController::class,'destroy'])->name('answer.delete');
Route::get('/answers/archived',[AnswerController::class,'archived_answers'])->name('answers.archived');
Route::get('/answers/restore/{id}',[AnswerController::class,'restore'])->name('answer.restore');
Route::get('/answers/hDelete/{id}',[AnswerController::class,'hard_delete_answer'])->name('answer.hard_delete');

// Route::get('/exam/create',[ExamController::class,'create'])->name('exam.create');
// Route::post('/exam/store',[ExamController::class,'store'])->name('exam.store');
// Route::get('/exam/{id}',[ExamController::class,'show'])->name('exam.show');
// Route::get('/exams',[ExamController::class,'index'])->name('exams');
// Route::get('/exam/{id}/edit',[ExamController::class,'edit'])->name('exam.edit');
// Route::post('/exam/{id}',[ExamController::class,'update'])->name('exam.update');
// Route::get('/exam/{id}/delete',[ExamController::class,'destroy'])->name('exam.delete');
// Route::get('/exams/archived',[ExamController::class,'archived_exams'])->name('exams.archived');
// Route::get('/exams/restore/{id}',[ExamController::class,'restore'])->name('exam.restore');
// Route::get('/exams/hDelete/{id}',[ExamController::class,'hard_delete_exam'])->name('exam.hard_delete');

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

Route::resource('exam_questions', 'ExamQuestionController');
Route::get('select_examQuestion',[ExamQuestionController::class,'selectExamQuestion'])->name('select_examQuestion');




});







