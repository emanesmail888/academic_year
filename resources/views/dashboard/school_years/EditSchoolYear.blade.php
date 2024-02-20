@extends('layouts.master')
@section('title','Edit School Year')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Edit School Year</h5>

                        </div><!-- col-md-6 1-->
                        <div class="col-md-6">
                            <a href="{{route('school_years')}}" class="btn btn-success pull-right">all school years</a>


                        </div><!-- col-md-6 2-->
                    </div><!-- row -->

                </div><!-- panel-heading -->

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success " role="alert">{{Session::get('success')}}
                        </div>
                    @endif

                    {!! Form::open(['route' => ['school_year.update',$schoolYear->id],'', 'method' => 'post']) !!}
                     <div class="form-group">
                          {{ Form::label('SchoolYear', 'SchoolYear') }}
                          {{ Form::text('year',$schoolYear->year, null, array('class' => 'form-control','required'=>'','maxlength'=>'4')) }}
                             <span style="color:red">{{ $errors->first('year') }}</span>
                     </div>
                     {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}

                    {!! Form::close() !!}

                </div><!--panel-body  -->

            </div><!-- panel -->

        </div><!-- col-md-12 -->

    </div><!-- row -->

</div><!-- container -->



@endsection

