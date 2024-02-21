@extends('layouts.master')
@section('title','Add New ExamQuestion')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Add New ExamQuestion</h5>

                        </div><!-- col-md-6 1-->
                        <div class="col-md-6">
                            <a href="{{route('exam_questions')}}" class="btn btn-success pull-right">all exams_questions</a>


                        </div><!-- col-md-6 2-->
                    </div><!-- row -->

                </div><!-- panel-heading -->

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success " role="alert">{{Session::get('success')}}
                        </div>
                    @endif

                    {!! Form::open(['route' => 'exam_question.store', 'method' => 'post']) !!}
                     <div class="form-group">
                          {{ Form::label('Exam', 'ExamName') }}
                          {{ Form::select('exam_id', $exams ,null, ['class' => 'form-control', 'placeholder' => 'SelectExam']) }}

                             <span style="color:red">{{ $errors->first('exam_id') }}</span>
                     </div>
                     <div class="form-group">
                          {{ Form::label('Question', 'QuestionName') }}
                          {{ Form::select('question_id',  $questions,null, ['class' => 'form-control', 'placeholder' => 'SelectQuestion']) }}

                             <span style="color:red">{{ $errors->first('question_id') }}</span>
                     </div>


                     {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

                    {!! Form::close() !!}


                </div><!--panel-body  -->

            </div><!-- panel -->

        </div><!-- col-md-12 -->

    </div><!-- row -->

</div><!-- container -->



@endsection
