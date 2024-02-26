@extends('layouts.master')
@section('title', 'Add New Question')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5> {{ isset($question) ? 'Edit Question' : 'Add New Question' }}</h5>

                            </div><!-- col-md-6 1-->
                            <div class="col-md-6">
                                <a href="{{ route('questions.index') }}" class="btn btn-success pull-right">all questions</a>


                            </div><!-- col-md-6 2-->
                        </div><!-- row -->

                    </div><!-- panel-heading -->

                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success " role="alert">{{ Session::get('success') }}
                            </div>
                        @elseif(Session::has('fail'))
                            <div class="alert alert-danger" role="alert">{{ Session::get('fail') }}
                            </div>
                        @endif



                    @if (isset($question))

                        <form class="form-horizontal" action="{{ route('questions.update', $question->id) }}" method="POST">
                            @csrf
                            @method('PUT')



                            <!-- School Year -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">School Year</label>
                                <div class="col-md-10">
                                    <select name="school_year_id" id="school_year_id" class="form-control">
                                        <option value="{{ $question->subject->schoolClass->schoolYear->id }}">
                                            {{ $question->subject->schoolClass->schoolYear->year }}</option>
                                        @foreach ($school_years as $school_year)
                                            <option value="{{ $school_year->id }}">
                                                {{ $school_year->id === $question->subject->schoolClass->school_year_id ? 'selected' : '' }}
                                                {{ $school_year->year }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div><!-- form-group -->

                            <!-- School Class -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">School Class</label>
                                <div class="col-md-10">

                                    <select name="school_class_id" id="school_class_id" class="form-control">
                                        <option value="{{ $question->subject->schoolClass->id }}">
                                            {{ $question->subject->schoolClass->class_name }}</option>

                                    </select>

                                </div>
                            </div><!-- form-group -->

                            <!-- Subject ID -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">Subject ID:</label>
                                <div class="col-md-10">
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <option value="{{ $question->subject->id }}">
                                            {{ $question->subject->subject_name }}</option>

                                    </select>

                                    @error('subject_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- form-group -->

                            <!-- Question Name -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">question Name</label>
                                <div class="col-md-10">
                                    <input type="text" name="question_name" placeholder="question Name " id=""
                                        class="form-control" value="{{ $question->question_name }} " />
                                    @error('question_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- form-group -->


                            <!-- Answers -->
                            <div class="form-group col-md-10">
                                <label class="col-md-3 control-label">Answers:</label>
                                <div class="col-md-7" >
                                 @foreach ($question->answers as $index => $answer)
                                        <input type="text" name="answers[{{ $index }}][answer_text]"
                                            value="{{ $answer->answer_text }}" class="form-control" required>
                                        <input type="hidden" name="answers[{{ $index }}][id]"
                                            value="{{ $answer->id }}">
                                        <label>
                                            <input type="checkbox" name="answers[{{ $index }}][correct_answer]"
                                                value="1" {{ $answer->correct_answer ? 'checked' : '' }}>
                                            Correct Answer
                                        </label>
                                  @endforeach
                             </div>

                            </div><!-- form-group -->

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <input type="submit" value="Edit Question" class="btn btn-success">
                                </div>
                            </div><!-- form-group -->
                        </form>

                    @else
                    <form class="form-horizontal" action="{{ route('questions.store') }}" method="POST">
                        @csrf




                        <!-- School Year -->
                        <div class="form-group">
                            <label class="col-md-2 control-label">School Year</label>
                            <div class="col-md-10">
                                <select name="school_year_id" id="school_year_id" class="form-control">
                                    <option>Select school year to show classes</option>
                                    @foreach ($school_years as $school_year)
                                        <option value="{{ $school_year->id }}">
                                            {{ $school_year->year }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('school_year_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- form-group -->

                         <!-- School Year -->
                        <div class="form-group">
                            <label class="col-md-2 control-label">School Class</label>
                            <div class="col-md-10">

                                <select name="school_class_id" id="school_class_id" class="form-control">
                                    <option value="">Select a school class</option>
                                </select>
                                @error('school_class_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- form-group -->

                         <!-- Subject -->
                         <div class="form-group">
                            <label class="col-md-2 control-label">Subject</label>
                            <div class="col-md-10">

                                <select name="subject_id" id="subject_id" class="form-control">
                                    <option value="">Select a subject</option>
                                </select>
                                @error('subject_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- form-group -->
                        
                       <!-- Question Name -->
                        <div class="form-group ">
                            <label class="col-md-2 control-label">question Name</label>
                            <div class="col-md-10">
                                <input type="text" name="question_name" placeholder="Question Name " id=""
                                    class="form-control col-md-8" value=" " />
                                @error('question_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- form-group -->

                     <!-- Answers -->
                        <div class="form-group col-md-8">
                            <label class="col-md-3 control-label">Answers:</label>

                            <div class="answer-wrapper col-md-5 ">
                                <div >
                                    <input type="text" name="answers[0][answer_text]" class="form-control" required>
                                    <label>
                                        <input type="checkbox"  name="answers[0][correct_answer]">
                                        Correct Answer
                                    </label>
                                </div>

                            </div>
                            <button type="button" class="btn btn-info" id="add-answer">Add Answer</button>

                        </div><!-- form-group -->

                        <div class="form-group">
                            <label class="col-md-5 control-label"></label>
                            <div class="col-md-7">
                                <input type="submit" value="Add Question" class="btn btn-success">
                            </div>
                        </div><!-- form-group -->

                    </form>



                    @endif

                    </div><!--panel-body  -->

                </div><!-- panel -->

            </div><!-- col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->



@endsection

@section('scripts')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" async defer></script>
<script>
    $(document).ready(function() {
        $('#school_year_id').change(function() {
            var schoolYearId = $(this).val();

            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '{{ route('select_school_class') }}',
                data: {
                    school_year_id: schoolYearId
                },
                success: function(response) {
                    $('#school_class_id').html(response);
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#school_class_id').change(function() {
            var schoolClassId = $(this).val();

            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '{{ route('select_subject') }}',
                data: {
                    school_class_id: schoolClassId
                },
                success: function(response) {
                    $('#subject_id').html(response);
                }
            });
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add-answer').addEventListener('click', function () {
            var answerWrapper = document.querySelector('.answer-wrapper');
            var answerIndex = answerWrapper.children.length;

            var answerDiv = document.createElement('div');
            answerDiv.innerHTML = `
                <input type="text" name="answers[${answerIndex}][answer_text]" class="form-control" required>
                <label>
                    <input type="checkbox" name="answers[${answerIndex}][correct_answer]">
                    Correct Answer
                </label>
            `;

            answerWrapper.appendChild(answerDiv);
        });
    });
</script>

