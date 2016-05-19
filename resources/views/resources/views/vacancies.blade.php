<!-- resources/views/about.blade.php -->

@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Jaunākās vakances</h1>
    </div>
    

    @include('common.errors')

    @can('insert_vacancy')
    <a href="/vacancy/add" class="btn btn-primary btn-lg add_vacancy" role="button" >Pievienot vakanci</a>
    @endcan

    @if (count($vacancies) > 0)
        <table class="table">
            <tr>
                <th></th>
                <th>Pieteikties līdz</th>
                <th>Uzņēmums</th>
                <th>Nosaukums</th>
                <th>Apraksts</th>
            </tr>
            @foreach ($vacancies as $vacancy)
            <tr>
                <td><a href="/vacancy/{{$vacancy->id}}" >Skatīt</a></td>
                <td>{{$vacancy->duration}}</td>
                <td>{{$vacancy->name}}</td>
                <td>{{$vacancy->title}}</td>
                <td>{{$vacancy->description}}</td>
            </tr>
            @endforeach
        </table>
    @else
        <p>Nav nevienas vakances</p>
    @endif

@endsection