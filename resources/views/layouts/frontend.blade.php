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




       <!-- Bootstrap CSS -->
       {!! Html::style(asset('css/bootstrap.min.css')) !!}
       {!! Html::style(asset('css/line-icons.css')) !!}
       {!! Html::style(asset('css/owl.carousel.min.css')) !!}
       {!! Html::style(asset('css/owl.theme.default.css')) !!}
       {!! Html::style(asset('css/slicknav.min.css')) !!}
       {!! Html::style(asset('css/animate.css')) !!}
       {!! Html::style(asset('css/main.css')) !!}
       {!! Html::style(asset('css/responsive.css')) !!}
       {!! Html::style(asset('css/fontawesome.min.css')) !!}
       {!! Html::style(asset('css/style.css')) !!}


    @yield('css')
    </head>
    <body>

    <div id="wrapper">

    @include('includes.frontend.navbar')


    @include('includes.frontend.sidebar')

    <div class="mt-100">
        @yield('content')
    </div>

    @include('includes.frontend.footer')
    </div>


    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    {!! Html::script(asset('js/jquery-min.js')) !!}
    {!! Html::script(asset('js/sweetalert2.min.js')) !!}
    {!! Html::script(asset('js/popper.min.js')) !!}
    {!! Html::script(asset('js/bootstrap.min.js')) !!}
    {!! Html::script(asset('js/owl.carousel.min.js')) !!}
    {!! Html::script(asset('js/jquery.slicknav.js')) !!}
    {!! Html::script(asset('js/jquery.counterup.min.js')) !!}
    {!! Html::script(asset('js/waypoints.min.js')) !!}
    {!! Html::script(asset('js/form-validator.min.js')) !!}
    {!! Html::script(asset('js/contact-form-script.js')) !!}
    {!! Html::script(asset('js/main.js')) !!}

    @yield('js')
    </body>
</html>
