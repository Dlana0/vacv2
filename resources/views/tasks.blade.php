<!-- resources/views/application.blade.php -->

@extends('layout')

@section('content')
    @include('common.vacancy_head')

    @can('insert_vacancy')
    <a href="/task/add/{{$vacancy->id}}" class="btn btn-primary btn-lg add_vacancy" role="button" >Pievienot uzdevumu</a>
    @endcan

    @if (count($tasks) > 0)
        <table class="table">
            <tr>
                <th></th>
                <th>Virsraksts</th>
            </tr>
            @foreach ($tasks as $task)
                <tr>
                    <td><a href="/task/edit/{{$vacancy->id}}/{{$task->id}}" > rediģēt uzdevumu</a></td>
                    <td>{{$task->title}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Nav pievienots neviens uzdevums</p>

    @endif

@endsection