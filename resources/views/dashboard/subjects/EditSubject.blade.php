@extends('layouts.master')
@section('title','Edit Subject')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Edit Subject</h5>

                        </div><!-- col-md-6 1-->
                        <div class="col-md-6">
                            <a href="{{route('subjects')}}" class="btn btn-success pull-right">all subjects</a>


                        </div><!-- col-md-6 2-->
                    </div><!-- row -->

                </div><!-- panel-heading -->

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success " role="alert">{{Session::get('success')}}
                        </div>
                    @endif

                    {!! Form::open(['route' => ['subject.update',$subject->id],'', 'method' => 'post']) !!}
                    <div class="form-group">
                        {{ Form::label('Subject', 'SubjectName') }}
                        {{ Form::text('subject_name', $subject->subject_name, array('class' => 'form-control','required'=>'')) }}
                           <span style="color:red">{{ $errors->first('subject_name') }}</span>
                    </div>
                    <div class="form-group">
                        {{ Form::label('school_class_id', 'School Class') }}
                        {{ Form::select('school_class_id', $schoolClasses, $subject->school_class_id, ['class' => 'form-control']) }}
                            <span style="color:red">{{ $errors->first('school_class_id') }}</span>
                    </div>


                     {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

                    {!! Form::close() !!}

                </div><!--panel-body  -->

            </div><!-- panel -->

        </div><!-- col-md-12 -->

    </div><!-- row -->

</div><!-- container -->



@endsection

