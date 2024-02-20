@extends('layouts.master')
@section('title','All Soft Deleted School Years')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All Soft Deleted School Years</h5>

                            </div>

                            <div class="col-md-6">
                                <a href="{{route('school_years')}}" class="btn btn-success pull-right">all school years</a>

                            </div>
                        </div><!-- row -->

                    </div><!--panel-heading  -->
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schoolYears as $schoolYear)
                                <tr>
                                    <td>{{$schoolYear->id}}</td>
                                    <td>{{$schoolYear->year}}</td>
                                    <td>{{$schoolYear->created_at}}</td>
                                    <td>
                                        <a href="{{route('school_year.restore',['id'=>$schoolYear->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                        <a href="{{ route('school_year.hard_delete', $schoolYear->id) }}" onclick="confirm('Are You Sure, You Want to delete this Year Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
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
