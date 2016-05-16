<!--Stored in resources/views/layouts/layout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Vakances</title>

    <!-- Bootstrap CSS -->
    <link href="{{URL::asset('/assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


 
    <link href="/assets/css/style.css" rel="stylesheet">


</head>

<body>

<div class="container">

    <div class="topnav" >
    @if (!Auth::check())
        <div class="row" >
            <div class="col-sm-6" >
                <form class="form-inline" method="post" action="{{url('/login')}}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="lietotājvārds">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="parole">
                    </div>
                    <button type="submit" class="btn btn-default">Autorizēties</button>
                </form>
            </div>
            <div class="col_sm-4" >
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="/register">Reģistrēties</a></li>
                </ul>
            </div>
        </div>
    @else



        <ul class="nav nav-pills ">

            @can('insert_vacancy')
            <li role="listitem" ><a href="/profile">Uzņēmums: {{Auth::user()->name}}</a></li>
            <li role="presentation"><a href="/my_vacancies">Manas vakances</a></li>
            @endcan
            @can('apply_for_vacancy')
            <li role="listitem" ><a href="/profile">Vārds,Uzvārds: {{Auth::user()->name}}</a></li>
            <li role="presentation"><a href="/my_applications">Mani pieteikumi</a></li>
            @endcan
            @can('delete_all')
            <li role="listitem" ><a href="/profile">ADMIN</a></li>
            @endcan
            <li role="presentation"><a href="/logout">Atslēgties</a></li>
        </ul>

    @endif
    </div>
    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--
                <a class="navbar-brand" href="#">Darba apmācība</a>
                -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li ><a href="/">Sākums</a></li></li>
                    <li  ><a href="/about"  >Par mums</a></li></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left" role="search" action="/search" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Vakances nosaukums">
                        </div>
                        <button type="submit" class="btn btn-default">Meklēt vakanci</button>
                    </form>
                </ul>
            </div><!--/nav-->
        </div><!--/container-->
    </nav>
    
    
    <div class="container">
        @yield('content')
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row" >
                <div class="col-sm-6" >
                    <ul class="nav navbar-nav">
                        <li {{ (!isset($page)) ? 'class=active' : '' }} ><a href="/">Sākums</a></li></li>
                        <li {{ (isset($page) && $page == '/about') ? 'class=active' : '' }} ><a href="/about">Par mums</a></li></li>
                    </ul>
                </div>
                <div class="col-sm-6" >
                    <p class="text-muted text-right">Personāla atlases un apmācības automatizācijas rīks</p>
                </div>
            </div>
        </div>
    </footer>
</div> <!-- /container -->
<div stype="clear:both;" ></div>



<script src="/assets/js/jquery-1.12.3.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/bootstrap-datepicker.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="/assets/js/scripts.js"></script>

</body>
</html>
