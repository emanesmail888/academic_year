@extends('layouts.master')
@section('title', 'Add ||Edit Subject')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5> {{ isset($subject) ? 'Edit Subject' : 'Add New Subject' }}</h5>

                            </div><!-- col-md-6 1-->
                            <div class="col-md-6">
                                <a href="{{ route('subjects.index') }}" class="btn btn-success pull-right">all subjects</a>


                            </div><!-- col-md-6 2-->
                        </div><!-- row -->

                    </div><!-- panel-heading -->

                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success " role="alert">{{ Session::get('success') }}
                            </div>
                        @endif

                        @if (isset($subject))
                            <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-4 control-label">subject Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="subject_name" placeholder="Subject Name " id=""
                                            class="form-control" value="{{ $subject->subject_name ?? '' }} " />
                                        @error('subject_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-md-4 control-label">School Year</label>
                                    <div class="col-md-6">
                                        <select name="school_year_id" id="school_year_id" class="form-control">
                                            <option value="{{ $subject->schoolClass->schoolYear->id }}">
                                                {{ $subject->schoolClass->schoolYear->year }}</option>
                                            @foreach ($school_years as $school_year)
                                                <option value="{{ $school_year->id }}">
                                                    {{ $school_year->id === $subject->schoolClass->school_year_id ? 'selected' : '' }}
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
                                    <label class="col-md-4 control-label">School Class</label>
                                    <div class="col-md-6">

                                        <select name="school_class_id" id="school_class_id" class="form-control">
                                            <option value="{{ $subject->school_class_id }}">
                                                {{ $subject->schoolClass->class_name }}
                                            </option>
                                        </select>
                                        @error('school_class_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-6">
                                        <input type="submit" value="Edit Subject" class="btn btn-success">
                                    </div>
                                </div><!-- form-group -->
                            </form>
                        @else
                            <form action="{{ route('subjects.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-4 control-label">subject Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="subject_name" placeholder="Subject Name " id=""
                                            class="form-control" value=" " />
                                        @error('subject_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-md-4 control-label">School Year</label>
                                    <div class="col-md-6">
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
                                <div class="form-group">
                                    <label class="col-md-4 control-label">School Class</label>
                                    <div class="col-md-6">

                                        <select name="school_class_id" id="school_class_id" class="form-control">
                                            <option value="">Select a school class</option>
                                        </select>
                                        @error('school_class_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="col-md-4 control-label"></label>
                                    <div class="col-md-6">
                                        <input type="submit" value="Add Subject" class="btn btn-success">
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
        jQuery(document).ready(function() {
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
