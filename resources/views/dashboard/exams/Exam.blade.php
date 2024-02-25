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
                                <h5> {{isset($exams) ? 'All Exams' : 'Deleted Exams' }}</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('exams.create')}}" class="btn btn-success pull-right">add Exam</a>
                                <a href="{{route('exam.archived')}}" class="btn btn-success pull-right ">display deleted exams</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                @if(isset($exams))

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
                                        <a href="{{route('exams.edit',['exam'=>$exam->id])}}"><i class=" fa fa-edit fa-2x"></i></a>
                                        <form action="{{route('exams.destroy',['exam'=>$exam->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirm('Are You Sure, You Want to delete this Exam?')"><i class=" fa fa-times fa-2x"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$exams->links()}}


                    </div><!-- panel-body -->

                @elseif (isset($deleted_exams))
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
                                @foreach ($deleted_exams as $exam)
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
                        {{$deleted_exams->links()}}


                    </div><!-- panel-body -->
                    @endif
                </div><!-- panel -->
            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
