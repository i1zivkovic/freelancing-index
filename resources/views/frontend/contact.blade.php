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
                                <form id="contactForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Name" required >

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="Email" id="email" class="form-control"
                                                    name="name" required >

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="Subject" id="msg_subject" class="form-control"
                                                    required >

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="message" placeholder="Your Message"
                                                    rows="5"  required></textarea>

                                            </div>
                                            <div class="submit-button">
                                                <button class="btn btn-common" id="submit" type="submit">Send Message</button>
                                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                                        </div>
                                        <p><a href="mailto:i1zivkovic@outlook.com">Support: i1zivkovic@outlook.com</a></p>
                                    </div>
                                    <div class="single-contact">
                                        <div class="contact-icon">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                        <p><a href="#">Main number: +38599 3403 646</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="conatiner-map">
                                <iframe src="https://maps.google.com/maps?q=osijek&t=&z=11&ie=UTF8&iwloc=&output=embed"
                                    allowfullscreen=""></iframe>
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
