@extends('layouts.master')
@section('title','Add New Answer')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Add New Answer</h5>

                        </div><!-- col-md-6 1-->
                        <div class="col-md-6">
                            <a href="{{route('answers')}}" class="btn btn-success pull-right">all answers</a>


                        </div><!-- col-md-6 2-->
                    </div><!-- row -->

                </div><!-- panel-heading -->

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success " role="alert">{{Session::get('success')}}
                        </div>
                    @else
                        <div class="alert alert-danger " role="alert">{{Session::get('Fail')}}
                        </div>
                    @endif

                    {!! Form::open(['route' => 'answer.store', 'method' => 'post']) !!}
                     <div class="form-group">
                          {{ Form::label('Answer', 'Answer') }}
                          {{ Form::text('answer_text', null, array('class' => 'form-control','required'=>'')) }}
                             <span style="color:red">{{ $errors->first('answer_text') }}</span>
                     </div>
                     <div class="form-group">
                        {{ Form::label('question_id', 'Questions') }}
                        {{ Form::select('question_id', $questions, null, ['class' => 'form-control', 'placeholder' => 'SelectQuestion']) }}

                        <span style="color:red">{{ $errors->first('question_id') }}</span>
                    </div>
                    <div class="form-group">
                        {{ Form::label('correct_answer', 'Is Correct') }}
                        {{ Form::select('correct_answer', [0 => 'No', 1 => 'Yes'], null, ['class' => 'form-control']) }}
                        <span style="color:red">{{ $errors->first('correct_answer') }}</span>

                    </div>

                     {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

                    {!! Form::close() !!}





                </div><!--panel-body  -->

            </div><!-- panel -->

        </div><!-- col-md-12 -->

    </div><!-- row -->

</div><!-- container -->



@endsection

