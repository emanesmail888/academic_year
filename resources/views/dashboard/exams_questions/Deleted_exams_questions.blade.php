@extends('layouts.master')
@section('title','All Soft Deleted Exams_Questions')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Soft Deleted Exams_Questions</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('exam_questions')}}" class="btn btn-success pull-right">all exams questions</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Question</th>
                                    <th>Exam</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams_questions as $exams_question)
                                <tr>
                                    <td>{{$exams_question->id}}</td>
                                    <td>{{$exams_question->question_id}}</td>
                                    <td>{{$exams_question->exam_id}}</td>
                                    <td>{{$exams_question->created_at}}</td>
                                    <td>
                                        <a href="{{route('exams_question.restore',['id'=>$exams_question->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                        <a href="{{ route('exams_question.hard_delete', $exams_question->id) }}" onclick="confirm('Are You Sure, You Want to delete this ExamQuestion Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
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
