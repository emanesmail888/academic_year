@extends('layouts.master')
@section('title','All School Years')
@section('content')




    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($schoolYears))

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>All School Years</h5>

                                </div>

                                <div class="col-md-6">
                                    <a href="{{route('school_years.create')}}" class="btn btn-success pull-right">add school year</a>
                                    <a href="{{route('school_years.archived')}}" class="btn btn-success pull-right ">display deleted school years</a>

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
                                            <a href="{{route('school_years.edit',['school_year'=>$schoolYear->id])}}"><i class=" fa fa-edit fa-2x"></i></a>
                                            <form action="{{route('school_years.destroy',['school_year'=>$schoolYear->id])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn-destroy" onclick="confirm('Are You Sure, You Want to delete this School Year?')"><i class=" fa fa-times fa-2x"></i></button>
                                            </form>

                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>
                            {{$schoolYears->links()}}


                        </div><!-- panel-body -->

                    </div><!-- panel -->
                @elseif (isset($trashedYears))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>All trashed Years</h5>

                                </div>

                                <div class="col-md-6">
                                    <a href="{{route('school_years.create')}}" class="btn btn-success pull-right">add school year</a>
                                    <a href="{{route('school_years.archived')}}" class="btn btn-success pull-right ">display deleted school years</a>

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
                                    @foreach ($trashedYears as $trashedYear)
                                    <tr>
                                        <td>{{$trashedYear->id}}</td>
                                        <td>{{$trashedYear->year}}</td>
                                        <td>{{$trashedYear->created_at}}</td>
                                            <td>
                                                <a href="{{route('school_year.restore',['id'=>$trashedYear->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                                <a href="{{ route('school_year.hard_delete', $trashedYear->id) }}" onclick="confirm('Are You Sure, You Want to delete this Year Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
                                            </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>
                            {{$trashedYears->links()}}


                        </div><!-- panel-body -->

                    </div><!-- panel -->
                @endif

            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
