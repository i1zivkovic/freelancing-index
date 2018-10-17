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
                    <div class="row contact-form-area">
                        <div class="col-md-12 col-lg-6 col-sm-12">
                            <div class="contact-block">
                                <h2>Contact Form</h2>
                                {!! Form::open(['method' => 'POST', 'route' => ['frontend.sendMail'], 'autocomplete' => 'on','id' => 'sendMailForm', 'class' => 'form-ad']) !!}
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Name" required >

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input placeholder="Email" id="email" type="email"  class="form-control"
                                                name="email" required >

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Subject" name="subject" id="msg_subject" class="form-control"
                                                required >

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="message" name="message" placeholder="Your Message"
                                                rows="5"  required></textarea>

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
                                <h2>Contact Address</h2>
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
                                        </div><a href="mailto:i1zivkovic@outlook.com">Support: i1zivkovic@outlook.com</a>
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
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2793.765663854762!2d18.696152315560482!3d45.55503937910216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475ce7b7f11eb4e7%3A0x347e545141d6af20!2sUl.+Vijenac+Ivana+Me%C5%A1trovi%C4%87a+74%2C+31000%2C+Osijek!5e0!3m2!1shr!2shr!4v1539777886878" frameborder="0" style="border:0" allowfullscreen></iframe>
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
