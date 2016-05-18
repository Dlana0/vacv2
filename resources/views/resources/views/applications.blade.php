<!-- resources/views/application.blade.php -->

@extends('layout')

@section('content')
    @include('common.vacancy_head')
    @if (count($applications) > 0)
    <div class="row" >
        <div class="col-sm-4" >
            <ul class="nav nav-pills nav-stacked">
                @foreach ($applications as $a)
                    <li role="presentation" {{$a->id == $uapplication->id ? 'class=active':''}} >
                        <a href="/applications/{{$vacancy->id}}/{{$a->id}}/">{{$a->name}} ({{$a->created_at}})</a
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-8" >
            <dl class="dl-horizontal">
                <dt>izglītība:</dt>
                <dd>{{$uapplication->education}}</dd>
                <dt>komentāri:</dt>
                <dd>{!!nl2br($uapplication->comments)!!}</dd>

                <dt>sasniegumi:</dt>
                <dd>{!!nl2br($uapplication->archievments)!!}</dd>

                <dt>veids<dt>
                <dd>{{config('constants.application_type.'.$uapplication->type)}}</dd>

                <dt>status<dt>
                <dd>{{config('constants.application_status.'.$uapplication->status)}}</dd>

                <dt>cv</dt>
                <dd><a href="/file/{{$uapplication->file}}">Lejupielādēt CV</a></dd>

                <dt>Mainīt iesnieguma statusu</dt>
                <dd>
                    <form action="/application/status/{{$uapplication->id}}" method="post"  >
                        {!! csrf_field() !!}
                        <select name="status" id="change_status" onchange="this.form.submit()" >
                            <option value="0" {{ $uapplication->status == 0 ? 'selected="selected"':'' }} >{{config('constants.application_status.0')}}</option>
                            <option value="1" {{ $uapplication->status == 1 ? 'selected="selected"':'' }} >{{config('constants.application_status.1')}}</option>
                            <option value="2" {{ $uapplication->status == 2 ? 'selected="selected"':'' }} >{{config('constants.application_status.2')}}</option>
                            <option value="3" {{ $uapplication->status == 3 ? 'selected="selected"':'' }} >{{config('constants.application_status.3')}}</option>
                            <option value="4" {{ $uapplication->status == 4 ? 'selected="selected"':'' }} >{{config('constants.application_status.4')}}</option>
                        </select>
                    </form>
                </dd>
            </dl>
            <hr>
            @if($uapplication->status > 1 && count($answers) > 0)
                @foreach($answers as $a)
                <div class="task" >
                    <h3>{{$a->title}}</h3>
                    {!!$a->description!!}
                    <h4>Atbilde</h4>
                    {{$a->text}}
                    @if($a->file)
                        <p><a href="/file/{{$a->file}}">Lejupielādēt failu</a></p>
                    @endif
                    <div class="row" >
                    <form class="form-horizontal" action="/applications/{{$vacancy->id}}/{{$uapplication->id}}" id="answer_{{$a->answer_id}}" method="post" >
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$a->answer_id}}" />
                        <div class="form-group">
                            <label for="mark" class="col-sm-2 control-label">atzīme</label>
                            <div class="col-sm-10">
                                <select name="mark" id="mark" >
                                    <option value="0" {{ $a->mark == 0 ? 'selected="selected"':'' }} >{{config('constants.marks.0')}}</option>
                                    <option value="1" {{ $a->mark == 1 ? 'selected="selected"':'' }} >{{config('constants.marks.1')}}</option>
                                    <option value="2" {{ $a->mark == 2 ? 'selected="selected"':'' }} >{{config('constants.marks.2')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">piezīmes</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="note" name="note" >{{$a->note}}</textarea>
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
                @endforeach
            @endif

        </div>
    </div>
    @else
        <p>Nav neviena pieteikuma</p>
    @endif
@endsection