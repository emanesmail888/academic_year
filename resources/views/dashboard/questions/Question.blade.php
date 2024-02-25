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
                                <h5> {{ isset($allQuestions) ? 'All Questions' : 'Deleted Questions' }}</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('questions.create')}}" class="btn btn-success pull-right">add question</a>
                                <a href="{{route('question.archived')}}" class="btn btn-success pull-right ">display deleted questions</a>

                            </div>
                        </div><!-- row -->
                    </div><!--panel-heading  -->

                  @if(isset($allQuestions))

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
                                        <a href="{{route('questions.edit',['question'=>$question->id])}}"><i class=" fa fa-edit fa-2x"></i></a>
                                        <form action="{{route('questions.destroy',['question'=>$question->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirm('Are You Sure, You Want to delete this Question?')"><i class=" fa fa-times fa-2x"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$allQuestions->links()}}


                    </div><!-- panel-body -->

                  @elseif (isset($deleted_questions))

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
                                @foreach ($deleted_questions as $question)
                                <tr>
                                    <td>{{$question->id}}</td>
                                    <td>{{$question->question_name}}</td>
                                    <td>{{$question->subject_id}}</td>
                                    <td>{{$question->created_at}}</td>
                                    <td>
                                        <a href="{{route('question.restore',['id'=>$question->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                        <a href="{{ route('question.hard_delete', $question->id) }}" onclick="confirm('Are You Sure, You Want to delete this Question Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$deleted_questions->links()}}


                    </div><!-- panel-body -->
                  @endif

                </div><!-- panel -->
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
