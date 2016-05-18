<!-- resources/views/application.blade.php -->

@extends('layout')

@section('content')
    @include('common.vacancy_head')
    <dl class="dl-horizontal">
        <dt>izglītība:</dt>
        <dd>{{$application->education}}</dd>
        <dt>komentāri:</dt>
        <dd>{!!nl2br($application->comments)!!}</dd>

        <dt>sasniegumi:</dt>
        <dd>{!!nl2br($application->archievments)!!}</dd>

        <dt>veids<dt>
        <dd>{{config('constants.application_type.'.$application->type)}}</dd>

        <dt>status<dt>
        <dd>{{config('constants.application_status.'.$application->status)}}</dd>

        <dt>cv</dt>
        <dd><a href="/file/{{$application->file}}">Lejupielādēt CV</a></dd>
    </dl>



@endsection