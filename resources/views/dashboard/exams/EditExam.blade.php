@extends('layouts.master')
@section('title','Edit Exam')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Edit exam</h5>

                        </div><!-- col-md-6 1-->
                        <div class="col-md-6">
                            <a href="{{route('exams')}}" class="btn btn-success pull-right">all exams</a>


                        </div><!-- col-md-6 2-->
                    </div><!-- row -->

                </div><!-- panel-heading -->

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success " role="alert">{{Session::get('success')}}
                        </div>
                    @endif

                    {!! Form::open(['route' => ['exam.update',$exam->id],'', 'method' => 'post']) !!}
                    <div class="form-group">
                        {{ Form::label('Exam', 'Exam') }}
                        {{ Form::text('exam_name', $exam->exam_name, array('class' => 'form-control','required'=>'')) }}
                           <span style="color:red">{{ $errors->first('exam_name') }}</span>
                   </div>
                   <div class="form-group">
                    {{ Form::label('Date', 'Date') }}
                    {{ Form::date('exam_date', $exam->exam_date, ['class' => 'form-control']) }}
                    <span style="color:red">{{ $errors->first('exam_date') }}</span>
                   </div>

                     {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

                    {!! Form::close() !!}

                </div><!--panel-body  -->

            </div><!-- panel -->

        </div><!-- col-md-12 -->

    </div><!-- row -->

</div><!-- container -->



@endsection

