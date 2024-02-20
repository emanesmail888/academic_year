@extends('layouts.master')
@section('title','All Soft Deleted Subjects')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Soft Deleted Subjects</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('subjects')}}" class="btn btn-success pull-right">all subjects</a>

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
                                        <a href="{{route('subject.restore',['id'=>$subject->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                        <a href="{{ route('subject.hard_delete', $subject->id) }}" onclick="confirm('Are You Sure, You Want to delete this Subject Class Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
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
