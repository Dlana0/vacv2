<!-- resources/views/vacancy.blade.php -->

@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Pievienot vakanci</h1>
    </div>

    
    @include('common.errors')

    <div class="row" >
        <div class="col-sm-10" >
            <form class="form-horizontal" method="POST" action="/vacancy/add" >
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="title" class="col-sm-4 control-label">Vakances nosaukums</label>
                    <div class="col-sm-8">
                        <input type="string" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-4 control-label">Apraksts</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="description" name="description" >{{old('description')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="requirements" class="col-sm-4 control-label">Prasības</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="requirements" name="requirements" >{{old('requirements')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="knowledge" class="col-sm-4 control-label">Zināšanas</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="knowledge" name="knowledge" >{{old('knowledge')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="obligations" class="col-sm-4 control-label">Pienākumi</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="obligations" name="obligations" >{{old('obligations')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="duration" class="col-sm-4 control-label">Pieteikšanās termiņš</label>
                    <div class="col-sm-8">
                        <input type="string" class="form-control datepicker" id="duration" name="duration" value="{{old('duration')}}" >
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-default">Pievienot</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection