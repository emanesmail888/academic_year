@extends('layouts.master')
@section('title','All Subjects')
@section('content')




    <div class="container">
        <div class="row">
            <div class="col-md-12">
             @if(isset($subjects))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Subjects</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('subjects.create')}}" class="btn btn-success pull-right">add subject</a>
                                <a href="{{route('subject.archived')}}" class="btn btn-success pull-right ">display deleted subjects</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>school_class_id</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $subject)
                                <tr>
                                    <td>{{$subject->id}}</td>
                                    <td>{{$subject->subject_name}}</td>
                                    <td>{{$subject->school_class_id}}</td>
                                    <td>{{$subject->created_at}}</td>
                                    <td>
                                        <a href="{{route('subjects.edit',['subject'=>$subject->id])}}"><i class=" fa fa-edit fa-2x"></i></a>
                                        <form action="{{route('subjects.destroy',['subject'=>$subject->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirm('Are You Sure, You Want to delete this Subject?')"><i class=" fa fa-times fa-2x"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$subjects->links()}}


                    </div><!-- panel-body -->
                </div><!-- panel -->
             @elseif (isset($deleted_subjects))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Trashed Subjects</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('subjects.create')}}" class="btn btn-success pull-right">add subject</a>
                                <a href="{{route('subject.archived')}}" class="btn btn-success pull-right ">display deleted subjects</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>school_class_id</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deleted_subjects as $deleted_subject)
                                <tr>
                                    <td>{{$deleted_subject->id}}</td>
                                    <td>{{$deleted_subject->subject_name}}</td>
                                    <td>{{$deleted_subject->school_class_id}}</td>
                                    <td>{{$deleted_subject->created_at}}</td>
                                    <td>
                                        <a href="{{route('subject.restore',['id'=>$deleted_subject->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                        <a href="{{ route('subject.hard_delete', $deleted_subject->id) }}" onclick="confirm('Are You Sure, You Want to delete this Subject Class Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$deleted_subjects->links()}}


                    </div><!-- panel-body -->
                </div><!-- panel -->

             @endif

            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
