@extends('layouts.frontend')

@section('title', 'Login')
@section('description', "")

@section('content')

<!-- Content section Start -->
<section id="content" class="section-padding login-pd">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-xs-12">

                <div class="page-login-form box">
                        <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center mb-3">
                                    <h1 class="head-title"><span>THE</span><span>HUNT</span></h1>
                                </div>
                            </div>
                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-envelope"></i>
                                <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Keep Me Signed In</label>
                        </div> --}}
                        <button class="btn btn-common log-btn">Submit</button>
                    </form>
                    <ul class="form-links">
                        <li class="text-center"><a href="{{route('register')}}">Don't have an account?</a></li>
                        <li class="text-center"><a href="{{ route('password.request') }}">Forgot your password?
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Content section End -->
@include('includes.frontend.loaderAndArrow')
@endsection
