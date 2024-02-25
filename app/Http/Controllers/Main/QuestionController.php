<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use App\Models\SchoolYear;
use App\Models\SchoolClass;
use App\Models\Answer;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $subjects=Subject::cursor();
        $allQuestions=Question::paginate(10);
        return view('dashboard.questions.Question',compact(['subjects','allQuestions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
        $school_years=SchoolYear::cursor();
        return view('dashboard.questions.AddQuestion',compact(['school_years']));
    }


   public function selectSchoolClass(Request $request):JsonResponse
   {
    $schoolYearId = $request->input('school_year_id');

    // Retrieve the school classes based on the school_year_id
    $schoolClasses = DB::table('school_classes')
                        ->where('school_year_id', $schoolYearId)
                        ->get();

    // Generate the select option in html
    $options = '<option value="">Select a school class</option>';
    foreach ($schoolClasses as $class) {
        $options .= '<option value="'.$class->id.'">'.$class->class_name.'</option>';
    }

    // Return the select option  as a response in html
    return response()->json($options);
}

public function selectSubject(Request $request):JsonResponse
{
    $schoolClassId = $request->input('school_class_id');

    // Retrieve the subjects based on the school_class_id
    $subjects= DB::table('subjects')
                        ->where('school_class_id', $schoolClassId)
                        ->get();

    // Generate the select option in html
    $subjects_options = '<option value="">Select a subject</option>';
    foreach ($subjects as $subject) {
        $subjects_options .= '<option value="'.$subject->id.'">'.$subject->subject_name.'</option>';
    }

    // Return the select option  as a response in html
    return response()->json($subjects_options);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        $data = $request->validated();
            // Create the question
        $question = Question::create([
        'question_name' => $data['question_name'],
        'subject_id' => $data['subject_id'],
        ]);

        // Create the answers
        foreach ($data['answers'] as $answerData) {
            $answerText = $answerData['answer_text'];
            // $isCorrect =  $answerData['correct_answer'];
            $isCorrect = isset($answerData['correct_answer']) && $answerData['correct_answer'];

            $exists = Answer::where([
            'question_id' => $question->id,
            'correct_answer' => 1,])->exists();
            if ($exists) {
                if($isCorrect==1)
                {
                    return back()->with('success', 'This Question Has Already Answer True');
                }
                else{
                    $answer = new Answer([
                        'answer_text' =>$answerText ,
                        'correct_answer' => $isCorrect, ]);
                    $question->answers()->save($answer);
                    }
            }
            else{

                $answer = new Answer([
                'answer_text' => $answerText,
                'correct_answer' => $isCorrect,
                ]);
                $question->answers()->save($answer);

            }

    }

            return back()->with('success', 'Question and answers have been stored successfully');
        }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question):View
    {
        return view('dashboard.questions.ShowQuestion',compact('question'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $school_years=SchoolYear::cursor();
        $question->load('answers');
        return view('dashboard.questions.AddQuestion',compact(['question','school_years']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question):RedirectResponse
    {
        $data = $request->validated();
        // Update the question
        $question->update([
            'question_name' => $data['question_name'],
            'subject_id' => $data['subject_id'],
        ]);

        // Update or create the answers
        foreach ($data['answers'] as $answerData) {
            $answerId = $answerData['id'];
            $answerText = $answerData['answer_text'];
            $isCorrect = isset($answerData['correct_answer']) && $answerData['correct_answer'];
            $exists = Answer::where([
                'question_id' => $question->id,
                'correct_answer' => 1,])->exists();
                 if ($exists) {
                if($isCorrect==1)
                {
                    return back()->with('fail', 'This Question Has Already Answer True');
                }
                else{
                    $answer = Answer::updateOrCreate(['id' => $answerId], [
                        'answer_text' => $answerText,
                        'correct_answer' => $isCorrect,
                    ]);

                    $question->answers()->save($answer);
                    }
                    }
                   else{
                    $answer = Answer::updateOrCreate(['id' => $answerId], [
                        'answer_text' => $answerText,
                        'correct_answer' => $isCorrect,
                    ]);

                    $question->answers()->save($answer);
                    }
        }

        return back()->with('success', 'Question and answers have been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question):RedirectResponse
    {
     // Delete the question and its associated answers
        $question->answers()->delete();
        $question->delete();
        return redirect()->back()->with('success', 'Question deleted successfully.');
    }
     
    //get all trashed question deleted with softDelete
    public function archived_questions():View
    {
        $deleted_questions = Question::onlyTrashed()->paginate(10);
        return view('dashboard.questions.Question',compact(['deleted_questions']));
    }
   //restore questions which deleted with softDelete 
    public function restore($id):RedirectResponse
    {
        $question=Question::withTrashed()->where('id',$id);
        $answers=Answer::withTrashed()->where('question_id',$id);
        $question->restore();
        $answers->restore();
        return redirect()->route('questions.index');
    }
    // delete question with answers completely
    public function hard_delete_question($id):RedirectResponse
    {
        $question=Question::withTrashed()->where('id',$id);
        $answers=Answer::withTrashed()->where('question_id',$id);
        $question->forceDelete();
        $answers->forceDelete();
        return redirect()->route('questions.index');
    }
}
