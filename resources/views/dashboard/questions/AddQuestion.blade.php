@extends('layouts.master')
@section('title','Add New Question')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Add New Question</h5>

                        </div><!-- col-md-6 1-->
                        <div class="col-md-6">
                            <a href="{{route('questions')}}" class="btn btn-success pull-right">all questions</a>


                        </div><!-- col-md-6 2-->
                    </div><!-- row -->

                </div><!-- panel-heading -->

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success " role="alert">{{Session::get('success')}}
                        </div>
                    @endif

                    {!! Form::open(['route' => 'question.store', 'method' => 'post']) !!}
                     <div class="form-group">
                          {{ Form::label('Question', 'QuestionName') }}
                          {{ Form::text('question_name', null, array('class' => 'form-control','required'=>'')) }}
                             <span style="color:red">{{ $errors->first('question_name') }}</span>
                     </div>
                     <div class="form-group">
                        {{ Form::label('subject_id', 'Subjects') }}
                        {{ Form::select('subject_id', $subjects, null, ['class' => 'form-control', 'placeholder' => 'SelectSubject']) }}

                        <span style="color:red">{{ $errors->first('subject_id') }}</span>
                    </div>

                     {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

                    {!! Form::close() !!}


                </div><!--panel-body  -->

            </div><!-- panel -->

        </div><!-- col-md-12 -->

    </div><!-- row -->

</div><!-- container -->



@endsection

