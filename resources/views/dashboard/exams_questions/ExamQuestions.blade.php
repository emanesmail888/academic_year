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
                                <a href="{{route('exam_questions.create')}}" class="btn btn-success pull-right">add exam_question</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Question_id</th>
                                    <th>Exam_id</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exam_questions as $exam_question)
                                <tr>
                                    <td>{{$exam_question->question_id}}</td>
                                    <td>{{$exam_question->exam_id}}</td>
                                    <td>{{$exam_question->created_at}}</td>
                                    <td>
                                        <form action="{{ route('exam_questions.delete',['examId'=>$exam_question->exam_id,'questionId'=>$exam_question->question_id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirm('Are You Sure, You Want to delete this Exam?')"><i class=" fa fa-times fa-2x"></i></button>
                                        </form>

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
