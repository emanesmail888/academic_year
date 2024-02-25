@extends('layouts.master')
@section('title', 'Add New School Class')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5> {{ isset($schoolClass) ? 'Edit School Class' : 'Add New School Class' }}</h5>

                            </div><!-- col-md-6 1-->

                            <div class="col-md-6">
                                <a href="{{ route('school_classes.index') }}" class="btn btn-success pull-right">all school
                                    classes</a>
                            </div><!-- col-md-6 2-->

                        </div><!-- row -->

                    </div><!-- panel-heading -->


                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success " role="alert">{{ Session::get('success') }}
                            </div>
                        @endif

                        @if (isset($schoolClass))
                            <form method="POST" action="{{ route('school_classes.update', $schoolClass->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-4 control-label">ClassName</label>
                                    <div class="col-md-6">
                                        <input type="text" name="class_name" placeholder="Class Name " id=""
                                            class="form-control" value=" {{ $schoolClass->class_name ?? '' }}" />
                                        @error('class_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label">School Year</label>
                                    <div class="col-md-6">
                                        <select name="school_year_id" class="form-control">
                                            @foreach ($school_years as $school_year)
                                                <option value="{{ $school_year->id }}"
                                                    {{ $school_year->id === $schoolClass->school_year_id ? 'selected' : '' }}>
                                                    {{ $school_year->year }}</option>
                                            @endforeach
                                        </select>
                                        @error('school_year_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-6">
                                        <input type="submit" value="Edit Class" class="btn btn-success">
                                    </div>
                                </div><!-- form-group -->

                            </form>
                        @else
                            <form action="{{ route('school_classes.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-4 control-label">ClassName</label>
                                    <div class="col-md-6">
                                        <input type="text" name="class_name" placeholder="Class Name " id=""
                                            class="form-control" value=" {{ $schoolClass->class_name ?? '' }}" />
                                        @error('class_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label">School Year</label>
                                    <div class="col-md-6">
                                        <select name="school_year_id" class="form-control">
                                            <option value="">select Year</option>
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

                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-6">
                                        <input type="submit" value="Add Class" class="btn btn-success">
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
