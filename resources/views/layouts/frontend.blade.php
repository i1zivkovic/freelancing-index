<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name', 'Ivan Živković') }}</title>
    <meta name="description" content="@yield('description')" />
    <meta name="author" content="Ivan Živković" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">


    {!! Html::style(asset('css/fontawesome.min.css')) !!}
    {!! Html::style(asset('css/bootstrap.css')) !!}
    {!! Html::style(asset('css/style.css')) !!}
    @yield('css')
    </head>
    <body>

    <div id="wrapper">

    @include('includes.frontend.navbar')


    @include('includes.frontend.sidebar')


    @yield('content')


    @include('includes.frontend.footer')
    </div>


    {!! Html::script(asset('js/jquery-3.3.1.min.js')) !!}
    {!! Html::script(asset('js/tether.min.js')) !!}
    {!! Html::script(asset('js/popper.min.js')) !!}
    {!! Html::script(asset('js/bootstrap.min.js')) !!}
    {!! Html::script(asset('js/sweetalert2.min.js')) !!}
    @yield('js')
    </body>
</html>
