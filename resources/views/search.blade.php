<!-- resources/views/search.blade.php -->

@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Meklēšanas rezultāti frāzei: "{{$search}}"</h1>
    </div>
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
                    <td><a href="/vacancy/{{$vacancy->id}}" >apskatīt</a></td>
                    <td>{{$vacancy->duration}}</td>
                    <td>{{$vacancy->name}}</td>
                    <td>{{$vacancy->title}}</td>
                    <td>{{$vacancy->description}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Nekas netika atrasts</p>
    @endif
@endsection