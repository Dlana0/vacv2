<!-- resources/views/application.blade.php -->

@extends('layout')

@section('content')

    @include('common.vacancy_head')

    <div class="page-header">
        <h1>Pievienot uzdevumu</h1>
    </div>

    <!-- Display Validation Errors -->
    @include('common.errors')

    <div class="row" >
        <div class="col-sm-10" >
            <form class="form-horizontal" method="POST" action="" >
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">virsraksts</label>
                    <div class="col-sm-10">
                        <input type="string" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="virsraksts">
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">uzdevums</label>
                    <div class="col-sm-10" >
                        <textarea name="description" class="tinymce" >{!!old('description')!!}</textarea>
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Saglabāt</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection