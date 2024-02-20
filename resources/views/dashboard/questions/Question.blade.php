@extends('layouts.master')
@section('title','All Questions')
@section('content')




    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Questions</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('question.create')}}" class="btn btn-success pull-right">add question</a>
                                <a href="{{route('questions.archived')}}" class="btn btn-success pull-right ">display deleted questions</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Question</th>
                                    <th>subject_id</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allQuestions as $question)
                                <tr>
                                    <td>{{$question->id}}</td>
                                    <td>{{$question->question_name}}</td>
                                    <td>{{$question->subject_id}}</td>
                                    <td>{{$question->created_at}}</td>
                                    <td>
                                        <a href="{{route('question.edit',['id'=>$question->id])}}"><i class=" fa fa-edit fa-2x"></i></a>
                                        <a href="{{ route('question.delete', $question->id) }}" onclick="confirm('Are You Sure, You Want to delete this question?')"><i class=" fa fa-times fa-2x"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$allQuestions->links()}}


                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
