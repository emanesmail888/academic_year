@extends('layouts.master')
@section('title','All Soft Deleted Answers')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Soft Deleted Answers</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('answers')}}" class="btn btn-success pull-right">all answers</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>answer_text</th>
                                    <th>question_name</th>
                                    <th>is_correct_answer</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($answers as $answer)
                                <tr>
                                    <td>{{$answer->id}}</td>
                                    <td>{{$answer->answer_text}}</td>
                                    <td>{{$answer->question->question_name}}</td>
                                    <td>{{$answer->correct_answer}}</td>
                                    <td>{{$answer->created_at}}</td>
                                    <td>
                                        <a href="{{route('answer.restore',['id'=>$answer->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                        <a href="{{ route('answer.hard_delete', $answer->id) }}" onclick="confirm('Are You Sure, You Want to delete this Answer Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
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
