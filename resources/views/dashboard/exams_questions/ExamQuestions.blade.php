@extends('layouts.master')
@section('title','All Exams Questions')
@section('content')




    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Exams Questions</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('exam_question.create')}}" class="btn btn-success pull-right">add exam_question</a>
                                {{-- <a href="{{route('exam_questions.archived')}}" class="btn btn-success pull-right ">display deleted Exams_questions</a> --}}

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Question_id</th>
                                    <th>Question</th>
                                    <th>Exam_id</th>
                                    <th>Exam_name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exam_questions as $exam_question)
                                <tr>
                                    <td>{{$exam_question->question_id}}</td>
                                    <td>{{$exam_question->question->question_name}}</td>
                                    <td>{{$exam_question->exam_id}}</td>
                                    <td>{{$exam_question->exam->exam_name}}</td>
                                    <td>{{$exam_question->created_at}}</td>
                                    <td>
                                        <a href="{{route('exam_question.edit',['exam'=>$exam_question->exam_id,'question'=>$exam_question->question_id])}}"><i class=" fa fa-edit fa-2x"></i></a>
                                        <a href="{{ route('exam_question.delete',['exam'=>$exam_question->exam_id,'question'=>$exam_question->question_id]) }}" onclick="confirm('Are You Sure, You Want to delete this Exam Question?')"><i class=" fa fa-times fa-2x"></i></a>

                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$exam_questions->links()}}


                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
