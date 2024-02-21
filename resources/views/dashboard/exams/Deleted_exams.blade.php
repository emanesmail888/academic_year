@extends('layouts.master')
@section('title','All Soft Deleted Exams')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Soft Deleted Exams</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('exams')}}" class="btn btn-success pull-right">all exams</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>exam_name</th>
                                    <th>exam_date</th>
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
                                        <a href="{{route('exam.restore',['id'=>$exam->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                        <a href="{{ route('exam.hard_delete', $exam->id) }}" onclick="confirm('Are You Sure, You Want to delete this Exam Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>


                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
