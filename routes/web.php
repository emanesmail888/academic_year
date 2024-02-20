<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\SchoolYearController;
use App\Http\Controllers\Dashboard\SchoolClassesController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\AnswerController;
use App\Http\Controllers\Dashboard\ExamController;
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

Route::get('/school_year/create',[SchoolYearController::class,'create'])->name('school_year.create');
Route::post('/school_year/store',[SchoolYearController::class,'store'])->name('school_year.store');
Route::get('/school_year/{id}',[SchoolYearController::class,'show'])->name('school_year.show');
Route::get('/school_years',[SchoolYearController::class,'index'])->name('school_years');
Route::get('/school_year/{id}/edit',[SchoolYearController::class,'edit'])->name('school_year.edit');
Route::post('/school_year/{id}',[SchoolYearController::class,'update'])->name('school_year.update');
Route::get('/school_year/{id}/delete',[SchoolYearController::class,'destroy'])->name('school_year.delete');
Route::get('/school_years/archived',[SchoolYearController::class,'archived_school_years'])->name('school_years.archived');
Route::get('/school_years/restore/{id}',[SchoolYearController::class,'restore'])->name('school_year.restore');
Route::get('/school_years/hDelete/{id}',[SchoolYearController::class,'hard_delete_school_year'])->name('school_year.hard_delete');


Route::get('/school_class/create',[SchoolClassesController::class,'create'])->name('school_class.create');
Route::post('/school_class/store',[SchoolClassesController::class,'store'])->name('school_class.store');
Route::get('/school_class/{id}',[SchoolClassesController::class,'show'])->name('school_class.show');
Route::get('/school_classes',[SchoolClassesController::class,'index'])->name('school_classes');
Route::get('/school_class/{id}/edit',[SchoolClassesController::class,'edit'])->name('school_class.edit');
Route::post('/school_class/{id}',[SchoolClassesController::class,'update'])->name('school_class.update');
Route::get('/school_class/{id}/delete',[SchoolClassesController::class,'destroy'])->name('school_class.delete');
Route::get('/school_classes/archived',[SchoolClassesController::class,'archived_school_classes'])->name('school_classes.archived');
Route::get('/school_classes/restore/{id}',[SchoolClassesController::class,'restore'])->name('school_class.restore');
Route::get('/school_classes/hDelete/{id}',[SchoolClassesController::class,'hard_delete_school_class'])->name('school_class.hard_delete');


Route::get('/subject/create',[SubjectController::class,'create'])->name('subject.create');
Route::post('/subject/store',[SubjectController::class,'store'])->name('subject.store');
Route::get('/subject/{id}',[SubjectController::class,'show'])->name('subject.show');
Route::get('/subjects',[SubjectController::class,'index'])->name('subjects');
Route::get('/subject/{id}/edit',[SubjectController::class,'edit'])->name('subject.edit');
Route::post('/subject/{id}',[SubjectController::class,'update'])->name('subject.update');
Route::get('/subject/{id}/delete',[SubjectController::class,'destroy'])->name('subject.delete');
Route::get('/subjects/archived',[SubjectController::class,'archived_subjects'])->name('subjects.archived');
Route::get('/subjects/restore/{id}',[SubjectController::class,'restore'])->name('subject.restore');
Route::get('/subjects/hDelete/{id}',[SubjectController::class,'hard_delete_subject'])->name('subject.hard_delete');

Route::get('/question/create',[questionController::class,'create'])->name('question.create');
Route::post('/question/store',[questionController::class,'store'])->name('question.store');
Route::get('/question/{id}',[questionController::class,'show'])->name('question.show');
Route::get('/questions',[questionController::class,'index'])->name('questions');
Route::get('/question/{id}/edit',[questionController::class,'edit'])->name('question.edit');
Route::post('/question/{id}',[questionController::class,'update'])->name('question.update');
Route::get('/question/{id}/delete',[questionController::class,'destroy'])->name('question.delete');
Route::get('/questions/archived',[questionController::class,'archived_questions'])->name('questions.archived');
Route::get('/questions/restore/{id}',[questionController::class,'restore'])->name('question.restore');
Route::get('/questions/hDelete/{id}',[questionController::class,'hard_delete_question'])->name('question.hard_delete');



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

Route::get('/exam/create',[ExamController::class,'create'])->name('exam.create');
Route::post('/exam/store',[ExamController::class,'store'])->name('exam.store');
Route::get('/exam/{id}',[ExamController::class,'show'])->name('exam.show');
Route::get('/exams',[ExamController::class,'index'])->name('exams');
Route::get('/exam/{id}/edit',[ExamController::class,'edit'])->name('exam.edit');
Route::post('/exam/{id}',[ExamController::class,'update'])->name('exam.update');
Route::get('/exam/{id}/delete',[ExamController::class,'destroy'])->name('exam.delete');
Route::get('/exams/archived',[ExamController::class,'archived_exams'])->name('exams.archived');
Route::get('/exams/restore/{id}',[ExamController::class,'restore'])->name('exam.restore');
Route::get('/exams/hDelete/{id}',[ExamController::class,'hard_delete_exam'])->name('exam.hard_delete');

