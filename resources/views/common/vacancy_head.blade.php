<!-- resources/views/common/errors.blade.php -->
@if(isset($vacancy) && count($vacancy) > 0 )
<div class="jumbotron">
    <h1>Vakance: {{$vacancy->title}}</h1>
    <p>{{$vacancy->description}}</p>
    <p>pieteikties līdz: {{$vacancy->duration}}</p>
</div>

<ul class="nav nav-tabs">
    <li role="presentation" {{$request->path() == 'vacancy/'.$vacancy->id ? 'class=active':''}}   ><a href="/vacancy/{{$vacancy->id}}">vakances apraksts</a></li>
    @if( isset($application) && count($application)>0)
        <li role="presentation" {{$request->path() == 'application/'.$application->id ? 'class=active':''}} ><a href="/application/{{$application->id}}" >pieteikums</a></li>
        @if($application->status > 1)
            <li role="presentation" {{$request->is('answer_tasks/*')? 'class=active':''}}  ><a href="/answer_tasks/{{$vacancy->id}}">apmācība</a></li>
        @endif
    @else
        @can('apply_for_vacancy')
        <li role="presentation" {{$request->path() == 'vacancy/'.$vacancy->id.'/apply' ? 'class=active':''}} ><a href="/vacancy/{{$vacancy->id}}/apply" >pieteikties vakancei</a></li>
        @endcan
    @endif

    @can('insert_vacancy')
        @if($vacancy->user_id == Auth::id())
        <li role="presentation" {{$request->path() == 'tasks/'.$vacancy->id ? 'class=active':''}} ><a href="/tasks/{{$vacancy->id}}" >apmācība</a></li>
        <li role="presentation" {{$request->is('applications/*') ? 'class=active':''}} ><a href="/applications/{{$vacancy->id}}" >pieteikumi</a></li>
        <li role="presentation" {{$request->is('vacancy/'.$vacancy->id.'/delete') ? 'class=active':''}} ><a href="/vacancy/{{$vacancy->id}}/delete" id="delete_vacancy" >dzēst vakanci</a></li>
        @endif
    @endcan

    @can('delete_all')
        <li role="presentation" {{$request->is('vacancy/'.$vacancy->id.'/delete') ? 'class=active':''}} ><a href="/vacancy/{{$vacancy->id}}/delete" id="delete_vacancy" >dzēst vakanci</a></li>
    @endcan

</ul>
<br />
@endif