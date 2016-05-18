<!-- resources/views/about.blade.php -->

@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Mani pieteikumi vakancēm</h1>
    </div>
    <!-- Display Validation Errors -->
    @include('common.errors')


    @if (count($applications) > 0)
        <table class="table">
            <tr>
                <th>pieteikuma statuss</th>
                <th>Datums</th>
                <th>Vakances nosaukums</th>
                <th></th>
            </tr>
            @foreach ($applications as $application)
            <tr>
                <td>{{config('constants.application_status.'.$application->status)}}</td>
                <td>{{$application->created_at}}</td>
                <td>{{$application->title}}</td>
                <td>
                    <a href="/application/{{$application->id}}" > apskatīt pieteikumu</a>
                </td>
            </tr>
            @endforeach
        </table>
    @else
        <p>Nav neviena pieteikuma</p>
    @endif

@endsection