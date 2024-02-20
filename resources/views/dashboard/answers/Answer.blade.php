@extends('layouts.master')
@section('title','All Answers')
@section('content')




    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Answers</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('answer.create')}}" class="btn btn-success pull-right">add Answer</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Answer Text</th>
                                    <th>question_id</th>
                                    <th>question_name</th>
                                    <th>is_correct</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allAnswers as $answer)
                                <tr>
                                    <td>{{$answer->id}}</td>
                                    <td>{{$answer->answer_text}}</td>
                                    <td>{{$answer->question_id}}</td>
                                    <td>{{$answer->question->question_name}}
                                    <td>{{$answer->correct_answer}}</td>
                                    <td>{{$answer->created_at}}</td>
                                    <td>
                                        <a href="{{route('answer.edit',['id'=>$answer->id])}}"><i class=" fa fa-edit fa-2x"></i></a>
                                        <a href="{{ route('answer.delete', $answer->id) }}" onclick="confirm('Are You Sure, You Want to delete this Answer?')"><i class=" fa fa-times fa-2x"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$allAnswers->links()}}


                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
