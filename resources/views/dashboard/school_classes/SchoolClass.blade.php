@extends('layouts.master')
@section('title','All School Classes')
@section('content')




    <div class="container">
        <div class="row">
            <div class="col-md-12">
            @if(isset($schoolClasses))

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All School Classes</h5>
                            </div>

                            <div class="col-md-6">
                                <a href="{{route('school_classes.create')}}" class="btn btn-success pull-right">add school class</a>
                                <a href="{{route('school_classes.archived')}}" class="btn btn-success pull-right ">display deleted school classes</a>
                            </div>
                        </div><!-- row -->
                    </div><!--panel-heading  -->

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>school_year_id</th>
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
                                        <a href="{{route('school_classes.edit',['school_class'=>$schoolClass->id])}}"><i class=" fa fa-edit fa-2x"></i></a>
                                        <form action="{{route('school_classes.destroy',['school_class'=>$schoolClass->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirm('Are You Sure, You Want to delete this School Class?')"><i class=" fa fa-times fa-2x"></i></button>
                                        </form>

                                    </td>
                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$schoolClasses->links()}}


                    </div><!-- panel-body -->

                </div><!-- panel -->

            @elseif (isset($trashedClasses))

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>All School Classes</h5>
                            </div>

                            <div class="col-md-6">
                                <a href="{{route('school_classes.create')}}" class="btn btn-success pull-right">add school class</a>
                                <a href="{{route('school_classes.archived')}}" class="btn btn-success pull-right ">display deleted school classes</a>
                            </div>
                        </div><!-- row -->
                    </div><!--panel-heading  -->

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>school_year_id</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trashedClasses as $trashedClass)
                                <tr>
                                    <td>{{$trashedClass->id}}</td>
                                    <td>{{$trashedClass->class_name}}</td>
                                    <td>{{$trashedClass->school_year_id}}</td>
                                    <td>{{$trashedClass->created_at}}</td>
                                    <td>
                                        <a href="{{route('school_class.restore',['id'=>$trashedClass->id])}}"><i class=" fa fa-undo fa-2x"></i></a>
                                        <a href="{{ route('school_class.hard_delete', $trashedClass->id) }}" onclick="confirm('Are You Sure, You Want to delete this School Class Permenantly?')"><i class=" fa fa-times fa-2x"></i></a>
                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>
                        {{$trashedClasses->links()}}


                    </div><!-- panel-body -->

                </div><!-- panel -->
            @endif

            </div><!-- col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
@endsection
