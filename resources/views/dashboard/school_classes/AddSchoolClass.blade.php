@extends('layouts.master')
@section('title','Add New School Class')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Add New School Class</h5>

                        </div><!-- col-md-6 1-->
                        <div class="col-md-6">
                            <a href="{{route('school_classes')}}" class="btn btn-success pull-right">all school classes</a>


                        </div><!-- col-md-6 2-->
                    </div><!-- row -->

                </div><!-- panel-heading -->

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success " role="alert">{{Session::get('success')}}
                        </div>
                    @endif

                    {!! Form::open(['route' => 'school_class.store', 'method' => 'post']) !!}
                     <div class="form-group">
                          {{ Form::label('SchoolClass', 'SchoolClassName') }}
                          {{ Form::text('class_name', null, array('class' => 'form-control','required'=>'')) }}
                             <span style="color:red">{{ $errors->first('class_name') }}</span>
                     </div>
                     <div class="form-group">
                        {{ Form::label('school_year_id', 'Years') }}
                        {{ Form::select('school_year_id', $school_years, null, ['class' => 'form-control', 'placeholder' => 'SelectYear']) }}

                        <span style="color:red">{{ $errors->first('school_year_id') }}</span>
                    </div>

                     {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

                    {!! Form::close() !!}


                </div><!--panel-body  -->

            </div><!-- panel -->

        </div><!-- col-md-12 -->

    </div><!-- row -->

</div><!-- container -->



@endsection

