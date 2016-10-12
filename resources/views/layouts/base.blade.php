<!DOCTYPE html>
<html>
<head>
    <title>Laravel @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="container">


    <div class="row">
        <div class="col-xs-12">
            @include('flash::message')
        </div>

    </div>

    <div class="row">

        <div class="col-sm-4">
            <ul class="nav">

                @section('sidebar')

                    <li>
                        <a href="{{ route('albums_index') }}"
                            @if (Route::is('albums_index'))
                                class="active"
                            @endif
                        >
                            Albumy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('albums_create') }}"
                            @if (Route::is('albums_create'))
                                class="active"
                            @endif
                        >
                            Dodaj nowy album
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('images_create') }}"
                            @if (Route::is('images_create'))
                                class="active"
                            @endif
                        >
                            Dodaj nowe zdjęcie
                        </a>
                    </li>

                @show

            </ul>


        </div>

        <div class="col-sm-8">

            @yield('content')

        </div>


    </div>
</div>

<script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>

</body>
</html>
