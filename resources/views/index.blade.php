@extends('layouts.master')
@section('content')
    <div class="container">
        <h1>Task Queries</h1>
        <p class="text-danger h4 ">School Years Count:
        <h4>{{ $school_years }}</h4>
        </p>
        <p class="text-danger h4 ">School classes Count:
        <h4>{{ $school_classes }}</h4>
        </p>
        <p class="text-danger h4 ">School Subjects Count:
        <h4>{{ $subjects }}</h4>
        </p>
        <hr>

        <p class="text-danger h4 ">classes in Each year</p>
        <table class="table  bg-light">
            <thead>
                <tr>
                    <th>year</th>
                    <th>school classess per year</th>
                </tr>
            </thead>
            <tbody>
                {{ $schoolClassesInYear }}
                @if ($schoolClassesInYear->count() > 0)
                    @foreach ($schoolClassesInYear as $schoolClass)
                        <tr>
                            <td>{{ $schoolClass->year }}</td>
                            <td>{{ $schoolClass->school_classes_count }}</td>
                        </tr>
                    @endforeach
                @else
                    <p>No Classes Found For This User.</p>
                @endif
            </tbody>
        </table>
        <p class="text-danger h4 ">subjects with year</p>
        <table class="table bg-light">
            <thead>
                <tr>
                    <th>year</th>
                    <th>school Subjects per year</th>
                </tr>
            </thead>
            <tbody>
                @if ($subjectsWithYear->count() > 0)
                    @foreach ($subjectsWithYear as $subject)
                        <tr>
                            <td>{{ $subject->year }}</td>
                            <td> {{ $subject->subjects->count() }}</td>
                        </tr>
                    @endforeach
                @else
                    <p>No Subjects Found For This User.</p>
                @endif
            </tbody>
        </table>

        <p class="text-danger h4 ">exams with year</p>
        <table class="table col-md-3 bg-light">
            <thead>
                <tr>
                    <th>year</th>
                </tr>
            </thead>
            {{$examsWithYear1}}
            <tbody>
                @if ($examsWithYear->count() > 0)
                    @foreach ($examsWithYear as $exam)
                        <tr>
                            @if (count($exam->exams) !== 0)
                                <td>{{ $exam->year }}</td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <p>No Exams Found For This Year.</p>
                @endif
            </tbody>
        </table>



    </div>
@endsection
