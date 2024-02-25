@extends('layouts.master')
@section('title', 'Add||Edit New Exam')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5> {{ isset($exam) ? 'Edit Exam' : 'Add New Exam' }}</h5>

                            </div><!-- col-md-6 1-->
                            <div class="col-md-6">
                                <a href="{{ route('exams.index') }}" class="btn btn-success pull-right">all exams</a>


                            </div><!-- col-md-6 2-->
                        </div><!-- row -->

                    </div><!-- panel-heading -->

                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success " role="alert">{{ Session::get('success') }}
                            </div>
                        @endif



                    @if (isset($exam))

                        <form class="form-horizontal" action="{{ route('exams.update', $exam->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Exam Name -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">exam Name</label>
                                <div class="col-md-10">
                                    <input type="text" name="exam_name" placeholder="Exam Name " id=""
                                        class="form-control" value="{{ $exam->exam_name }} " />
                                    @error('exam_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- form-group -->

                            <!-- Exam Date -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">exam Date</label>
                                <div class="col-md-10">
                                
                                    <input type="date" name="exam_date" id=""  class="form-control" value="{{$exam->exam_date}}"> 
                                   @error('exam_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- form-group -->

                            <!-- School Year -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">School Year</label>
                                <div class="col-md-10">
                                    <select name="school_year_id" id="school_year_id" class="form-control">
                                        <option value="{{ $exam->subject->schoolClass->schoolYear->id }}">
                                            {{ $exam->subject->schoolClass->schoolYear->year }}</option>
                                        @foreach ($school_years as $school_year)
                                            <option value="{{ $school_year->id }}">
                                                {{ $school_year->id === $exam->subject->schoolClass->school_year_id ? 'selected' : '' }}
                                                {{ $school_year->year }}
                                            </option>
                                        @endforeach
                                    </select>
                                   
                                </div>
                            </div><!-- form-group -->

                            <!-- School Class -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">School Class</label>
                                <div class="col-md-10">

                                    <select name="school_class_id" id="school_class_id" class="form-control">
                                        <option value="{{ $exam->subject->schoolClass->id }}">
                                            {{ $exam->subject->schoolClass->class_name }}</option>
                                       
                                    </select>
                                   
                                </div>
                            </div><!-- form-group -->

                            <!-- Subject ID -->
                            <div class="form-group">
                                <label class="col-md-2 control-label">Subject ID:</label>
                                <div class="col-md-10">
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <option value="{{ $exam->subject->id }}">
                                            {{ $exam->subject->subject_name }}</option>

                                    </select>

                                    @error('subject_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div><!-- form-group -->


                          

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <input type="submit" value="Edit Question" class="btn btn-success">
                                </div>
                            </div><!-- form-group -->
                        </form>

                    @else
                    <form class="form-horizontal" action="{{ route('exams.store') }}" method="POST">
                        @csrf
                         <!-- School Year -->
                         <div class="form-group">
                            <label class="col-md-2 control-label">School Year</label>
                            <div class="col-md-10">
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

                         <!-- School Class -->
                        <div class="form-group">
                            <label class="col-md-2 control-label">School Class</label>
                            <div class="col-md-10">

                                <select name="school_class_id" id="school_class_id" class="form-control">
                                    <option value="">Select a school class</option>
                                </select>
                                @error('school_class_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- form-group -->

                         <!-- Subject -->
                         <div class="form-group">
                            <label class="col-md-2 control-label">Subject</label>
                            <div class="col-md-10">

                                <select name="subject_id" id="subject_id" class="form-control">
                                    <option value="">Select a subject</option>
                                </select>
                                @error('subject_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- form-group -->

                         <!-- Exam Name  -->
                        <div class="form-group ">
                            <label class="col-md-2 control-label">Exam Name</label>
                            <div class="col-md-10">
                                <input type="text" name="exam_name" placeholder="Exam Name " id=""
                                    class="form-control col-md-8" value=" " />
                                @error('exam_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- form-group -->  

                        <!-- Exam Date -->                      
                        <div class="form-group ">
                            <label class="col-md-2 control-label">Exam Date</label>
                            <div class="col-md-10">
                                <input type="date" name="exam_date" placeholder="Exam Date " id=""
                                    class="form-control col-md-8" value=" " />
                                @error('exam_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- form-group -->                        

                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" value="Add Exam" class="btn btn-success">
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
    $(document).ready(function() {
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
<script>
    $(document).ready(function() {
        $('#school_class_id').change(function() {
            var schoolClassId = $(this).val();

            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '{{ route('select_subject') }}',
                data: {
                    school_class_id: schoolClassId
                },
                success: function(response) {
                    $('#subject_id').html(response);
                }
            });
        });

    });
</script>


