@extends('layouts.frontend')

@section('title', 'Contact')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')

<div class="">
    <div class="space-100">


        <!-- Contact Section Start -->
        <section id="contact" class="section">
            <div class="contact-form">
                <div class="container">

                    @if(session()->has('success'))
                    <div class="alert alert-success mb-3" role="alert">
                        Thanks for contacting us! We will make sure to contact you back as soon as possible!
                    </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-center mb-5">
                                <h3>Contact Us</h3>
                            </div>
                        </div>
                    </div>



                    <div class="row contact-form-area">

                        <div class="col-md-12 col-lg-6 col-sm-12">
                            <div class="contact-block">
                                {!! Form::open(['method' => 'POST', 'route' => ['frontend.sendMail'], 'autocomplete' =>
                                'on','id' => 'sendMailForm', 'class' => 'form-ad']) !!}
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                id="name" name="name" placeholder="Name" required value="{{old('name')}}">
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input placeholder="Email" id="email" type="email" class="form-control"
                                                {{ $errors->has('email') ? ' is-invalid' : '' }} name="email" required
                                                value="{{old('email')}}">
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Subject" name="subject" id="msg_subject"
                                                {{ $errors->has('subject') ? ' is-invalid' : '' }} class="form-control"
                                                required value="{{old('message')}}">
                                            @if ($errors->has('subject'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('subject') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="message" name="message" placeholder="Your Message"
                                                {{ $errors->has('message') ? ' is-invalid' : '' }} rows="5" required>{{old('message')}}</textarea>
                                            @if ($errors->has('message'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                        <div class="submit-button">
                                            <button class="btn btn-common" id="submit" type="submit">Send Message</button>
                                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                {!!Form::close()!!}
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-sm-12">
                            <div class="contact-right-area wow fadeIn">
                                <div class="contact-info">
                                    <div class="single-contact">
                                        <div class="contact-icon">
                                            <i class="lni-map-marker"></i>
                                        </div>
                                        <p>Vij. Ivana Meštrovića 74 - 31000 Osijek, Croatia</p>
                                    </div>
                                    <div class="single-contact">
                                        <div class="contact-icon">
                                            <i class="lni-envelope"></i>
                                        </div><a href="mailto:ivanzivkovic1601@gmail.com">Support:
                                            ivanzivkovic1601@gmail.com</a>
                                    </div>
                                    <div class="single-contact">
                                        <div class="contact-icon">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                        <p>Main number: +38599 3403 646</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="conatiner-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2793.765663854762!2d18.696152315560482!3d45.55503937910216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475ce7b7f11eb4e7%3A0x347e545141d6af20!2sUl.+Vijenac+Ivana+Me%C5%A1trovi%C4%87a+74%2C+31000%2C+Osijek!5e0!3m2!1shr!2shr!4v1539777886878"
                                    frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        @include('includes.frontend.loaderAndArrow')

        @section('js')
        {{-- --}}
        @stop
    </div>
</div>
@stop
