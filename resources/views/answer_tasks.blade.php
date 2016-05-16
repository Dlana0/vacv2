<!-- resources/views/application.blade.php -->

@extends('layout')

@section('content')
    @include('common.vacancy_head')

    @can('insert_vacancy')
    <a href="/task/add/{{$vacancy->id}}" class="btn btn-primary btn-lg add_vacancy" role="button" >Pievienot uzdevumu</a>
    @endcan
    <div class="row" >
        <div class="col-sm-4" >
            @if (count($tasks) > 0)
            <ul class="nav nav-pills nav-stacked">
                @foreach ($tasks as $t)
                    <li role="presentation" {{$t->id == $task->id ? 'class=active':''}} ><a href="/answer_tasks/{{$vacancy->id}}/{{$t->id}}/">{{$t->title}}</a></li>
                @endforeach
            </ul>
            @else
                <p>Nav pievienots neviens uzdevums</p>
            @endif
        </div>

        <div class="col-sm-8" >
            <div class="page-header">
                <h1>Uzdevums: {{$task->title}}</h1>
            </div>
            <div class="row" >
                {!!$task->description!!}
            </div>
            @if(count($answer) > 0)
                <p><b>Atbilde</b></p>
                <p>{{$answer->text}}</p>
                @if($answer->file)
                <p><a href="/file/{{$answer->file}}">Lejupielādēt failu</a></p>
                @endif
                @if($answer->mark)
                <p><b>atzīme:</b>{{config('constants.marks.'.$answer->mark)}}</p>
                @endif
                @if($answer->note)
                    <p>{{$answer->note}}</p>
                @endif

            @else
                @can('apply_for_vacancy')
                <div class="page-header">
                    <h1>Atbildēt</h1>
                </div>
                
                <!-- Display Validation Errors -->
                @include('common.errors')

                <div class="row" >
                    <div class="col-sm-10" >
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="/answer_tasks/{{$vacancy->id}}/{{$task->id}}" >
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="text" class="col-sm-2 control-label">Atbilde</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="text" name="text" >{{old('text')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file" class="col-sm-2 control-label">Fails</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file" name="file" value="{{old('file')}}" />
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
                @endcan
            @endif
        </div>
    </div>
    <div style="clear:both;" ></div>

@endsection