@extends('layouts.master')
@section('title','Add New School Year')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h5> {{isset($schoolYear)?"Edit School Year":"Add New School Year"}}</h5>

                        </div><!-- col-md-6 1-->
                        <div class="col-md-6">
                            <a href="{{route('school_years.index')}}" class="btn btn-success pull-right">all school years</a>


                        </div><!-- col-md-6 2-->
                    </div><!-- row -->

                </div><!-- panel-heading -->

                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success " role="alert">{{Session::get('success')}}
                        </div>
                    @endif

                   @if (isset($schoolYear))
                    <form class="form-horizontal" method="POST" action="{{ route('school_years.update', $schoolYear->id) }}" >
                        @method('PUT')
                    @else
                    <form class="form-horizontal" action="{{route('school_years.store')}}" method="POST" enctype="multipart/form-data" >

                    @endif
                        @csrf
                        <div class="form-group">
                            <label class="col-md-4 control-label">Year</label>
                            <div class="col-md-6">
                                <input type="text" name="year" placeholder="Year " id="" class="form-control" value=" {{$schoolYear->year ?? ''}}" />
                                @error('year')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror


                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                            @if (isset($schoolYear))
                             <input type="submit" value="Edit Year" class="btn btn-success">
                            @else
                             <input type="submit" value="Add Year" class="btn btn-success">
                            @endif
                            </div>
                        </div><!-- form-group -->

                    </form>


                </div><!--panel-body  -->
            </div><!-- panel -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- container -->



@endsection

