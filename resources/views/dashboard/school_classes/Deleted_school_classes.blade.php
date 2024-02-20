@extends('layouts.master')
@section('title','All Soft Deleted School Classes')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Soft Deleted School Classes</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('school_classes')}}" class="btn btn-success pull-right">all school classes</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>school_year</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schoolClasses as $schoolClass)
                                <tr>
                                    <td>{{$schoolClass->id}}</td>
                                    <td>{{$schoolClass->class_name}}</td>
                                    <td>{{$schoolClass->school_year_id}}</td>
                                    <td>{{$schoolClass->created_at}}</td>
                                    <td>
                                        <a href="{{route('school_class.restore',['id'=>$schoolClass->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                        <a href="{{ route('school_class.hard_delete', $schoolClass->id) }}" onclick="confirm('Are You Sure, You Want to delete this School Class Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
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
