<!-- resources/views/vacancy_apply.blade.php -->

@extends('layout')

@section('content')
    @include('common.vacancy_head')

    <!-- Display Validation Errors -->
    @include('common.errors')
    <div class="row" >
        <div class="col-sm-10" >
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="/vacancy/{{$vacancy->id}}/apply" >
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="education" class="col-sm-2 control-label">Izglītība</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="education" name="education" >{{old('education')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comments" class="col-sm-2 control-label">Komentāri</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="comments" name="comments" >{{old('comments')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="archievments" class="col-sm-2 control-label">Sasniegumi</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="archievments" name="archievments" >{{old('archievments')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-sm-2 control-label">Veids</label>
                    <div class="col-sm-8">
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" value="1" > Darbs
                            </label>
                            <label>
                                <input type="radio" name="type" value="2" > Brīvprātīga Prakse
                            </label>
                            <label>
                                <input type="radio" name="type" value="3" > Oficiāla prakse
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">CV</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="file" name="file" value="{{old('value')}}" />
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-default">Pievienot</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection