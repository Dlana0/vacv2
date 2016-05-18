<!-- resources/views/vacancy.blade.php -->

@extends('layout')

@section('content')

    @include('common.vacancy_head')

    @can('insert_vacancy')
        @if($vacancy->user_id == Auth::id())
        <a href="/vacancy/{{$vacancy->id}}/edit" class="btn btn-primary btn-lg add_vacancy" role="button" >Labot aprakstu</a>
        @endif
    @endcan

    <dl class="dl-horizontal">

        <dt>nosakums:</dt>
        <dd>{{$vacancy->title}}</dd>
        <dt>apraksts:</dt>
        <dd>{!!nl2br($vacancy->description)!!}</dd>

        <dt>prasības:</dt>
        <dd>{!!nl2br($vacancy->requirements)!!}</dd>

        <dt>zināšanas</dt>
        <dd>{!!nl2br($vacancy->knowledge)!!}</dd>

        <dt>pienākumi</dt>
        <dd>{!!nl2br($vacancy->obligations)!!}</dd>

        <dt>beigu termiņš:</dt>
        <dd>{{$vacancy->duration}}</dd>
        @can('apply_for_vacancy')
        @if(count($application) == 0)
        <dt></dt>
        <dd><a href="/vacancy/{{$vacancy->id}}/apply" class="btn btn-primary">Pieteikties</a></dd>
        @endif
        @endcan
    </dl>


@endsection