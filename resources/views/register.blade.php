<!-- resources/views/about.blade.php -->

@extends('layout')

@section('content')
<div class="page-header">
    <h1>Reģistrēties</h1>
</div>
<!-- Display Validation Errors -->
@include('common.errors')


<div class="row" >
    <div class="col-sm-10" >
        <form class="form-horizontal" method="POST" action="" >
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="username" class="col-sm-4 control-label">Lietotājvārds</label>
                <div class="col-sm-8">
                    <input type="string" class="form-control" id="username" name="username" value="{{old('name')}}" placeholder="lietotājvārds">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-4 control-label">E-pasts</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-pasts">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-4 control-label">Parole</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Parole">
                </div>
            </div>
            <div class="form-group">
                <label for="password2" class="col-sm-4 control-label">Paroles apstiprinājums</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Paroles apstiprinājums">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-4 control-label">Vārds, Uzvārds/Uzņēmuma nosaukums</label>
                <div class="col-sm-8">
                    <input type="string" class="form-control" id="name" name="name" placeholder="Vārds, Uzvārds/Uzņēmuma nosaukums">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-4 control-label">Veids</label>
                <div class="col-sm-8">
                    <div class="radio">
                        <label>
                            <input type="radio" name="type" value="1" > Darba devējs
                        </label>
                        <label>
                            <input type="radio" name="type" value="2" > Kandidāts
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">

                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-default">Reģistrēties</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection