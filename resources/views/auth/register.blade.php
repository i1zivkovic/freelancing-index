@extends('layouts.frontend')

@section('title', 'Register')
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
                    <form class="login-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-user"></i>
                                <input placeholder="Username" id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                    name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-envelope"></i>
                                <input placeholder="Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ old('email') }}" required>

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
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-unlock"></i>
                                <input placeholder="Confirm password" id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-common log-btn mt-3">Sign Up</button>
                        <p class="text-center">Already have an account?<a href="{{route('login')}}"> Log In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Content section End -->
@include('includes.frontend.loaderAndArrow')
@endsection
