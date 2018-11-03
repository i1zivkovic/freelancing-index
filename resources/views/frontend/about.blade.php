@extends('layouts.frontend')

@section('title', 'About Us')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')

<div class="">
    <div class="space-100">

        <!-- Main container Start -->
        <div class="about section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="about-content">
                            <h3>About TheHunt</h3>
                            <p>TheHunt is a wesbite devoted to posting and applying to freelance jobs. Currently
                                dedicated to coding and graphic desing work. Other features are in development process.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <img class="img-fluid float-right" src="{{asset('img')}}/about/img1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Main container End -->



        @include('includes.frontend.loaderAndArrow')

        @section('js')
        {{-- --}}
        @stop
    </div>
</div>
@stop
