<!-- resources/views/about.blade.php -->

@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Manas vakances</h1>
    </div>
    <!-- Display Validation Errors -->
    @include('common.errors')

    @can('insert_vacancy')
    <a href="/vacancy/add" class="btn btn-primary btn-lg add_vacancy" role="button" >Pievienot vakanci</a>
    @endcan

    @if (count($vacancies) > 0)
        <table class="table">
            <tr>
                <th>Pieteikties līdz</th>
                <th>Nosaukums</th>
                <th>Apraksts</th>
                <th></th>
            </tr>
            @foreach ($vacancies as $vacancy)
            <tr>
                <td>{{$vacancy->duration}}</td>
                <td>{{$vacancy->title}}</td>
                <td>{{$vacancy->description}}</td>
                <td><a href="/vacancy/{{$vacancy->id}}" >Pieteikumi, apmācība, labošana</a></td>
            </tr>
            @endforeach
        </table>
    @endif

@endsection