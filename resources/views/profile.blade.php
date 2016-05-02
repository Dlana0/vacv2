<!-- resources/views/vacancy.blade.php -->

@extends('layout')

@section('content')

    <div class="page-header">
        <h1>Profila dati</h1>
    </div>
    <dl class="dl-horizontal">

        <dt>Lietotājvārds:</dt>
        <dd>{!!nl2br($user->username)!!}</dd>

        <dt>E-pasts:</dt>
        <dd>{!!nl2br($user->email)!!}</dd>

        <dt>vārds,uzvārds/uzņēmuma nosaukums</dt>
        <dd>{!!nl2br($user->name)!!}</dd>
    </dl>

@endsection