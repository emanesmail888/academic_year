@extends('layouts.master')
@section('title','All Exams')
@section('content')




    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Exams</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('exam.create')}}" class="btn btn-success pull-right">add Exam</a>
                                <a href="{{route('exams.archived')}}" class="btn btn-success pull-right ">display deleted exams</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Exame Name</th>
                                    <th>Exam Date</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $exam)
                                <tr>
                                    <td>{{$exam->id}}</td>
                                    <td>{{$exam->exam_name}}</td>
                                    <td>{{$exam->exam_date}}</td>
                                    <td>{{$exam->created_at}}</td>
                                    <td>
                                        <a href="{{route('exam.edit',['id'=>$exam->id])}}"><i class=" fa fa-edit fa-2x"></i></a>
                                        <a href="{{ route('exam.delete', $exam->id) }}" onclick="confirm('Are You Sure, You Want to delete this Exam?')"><i class=" fa fa-times fa-2x"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$exams->links()}}


                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
