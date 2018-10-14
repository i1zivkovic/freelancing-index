@extends('layouts.frontend')

@section('title', 'Home')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')

{{-- <ul>
    @guest
    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
    @else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="/dashboard" class="dropdown-item">{{ __('Dashboard') }}</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    @endguest
</ul>
<p>
    {{ $user->email }}
</p>

@foreach($user->userSkills as $skill)
<p>

    {{ $skill->name }}

</p>
@endforeach
<p>

    {{ $user->userLocation ? $user->userLocation->city : 'Nema grad'}}
</p>
<img src="{{asset('uploads')}}/{{$user->username}}/thumb/{{$user->userProfile->image_url}}" /> --}}

<div class="container">
    <div class="row space-100">
        <div class="col-lg-7 col-md-12 col-xs-12 mb-5">
            <div class="contents">
                <h2 class="head-title">Find the <br> job that fits your skills or create a job ad yourself.</h2>
                <p>Search over 60,000+ job ads and find the one that suits your skills and requirements.</p>
                <div class="job-search-form">
                    <form>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Job Title or Company Name">
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <div class="form-group">
                                    <div class="search-category-container">
                                        <label class="styled-select">
                                            <select>
                                                <option value="none">Locations</option>
                                                <option value="none">New York</option>
                                                <option value="none">California</option>
                                                <option value="none">Washington</option>
                                                <option value="none">Birmingham</option>
                                                <option value="none">Chicago</option>
                                                <option value="none">Phoenix</option>
                                            </select>
                                        </label>
                                    </div>
                                    <i class="lni-map-marker"></i>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12">
                                <button type="submit" class="button"><i class="lni-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                        <p class="mt-4">... Or create a job ad yourself and hire the person that matches your requirements.</p>
                        <div class="col-12 text-center">
                            <a href="job-page.html" class="btn btn-common">Post a Job</a>
                        </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 col-xs-12">
            <div class="intro-img">
                <img src="{{asset('img')}}/intro.png" alt="">
            </div>
        </div>
    </div>
</div>


<!-- Category Section Start -->
<section class="category section bg-gray">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Browse Categories</h2>
            <p>Most popular categories of portal, sorted by popularity</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-xs-12 f-category">
                <a href="browse-jobs.html">
                    <div class="icon bg-color-1">
                        <i class="lni-home"></i>
                    </div>
                    <h3>Finance</h3>
                    <p>(4286 jobs)</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12 f-category">
                <a href="browse-jobs.html">
                    <div class="icon bg-color-2">
                        <i class="lni-world"></i>
                    </div>
                    <h3>Sale/Markting</h3>
                    <p>(2000 jobs)</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12 f-category">
                <a href="browse-jobs.html">
                    <div class="icon bg-color-3">
                        <i class="lni-book"></i>
                    </div>
                    <h3>Education/Training</h3>
                    <p>(1450 jobs)</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12 f-category">
                <a href="browse-jobs.html">
                    <div class="icon bg-color-4">
                        <i class="lni-display"></i>
                    </div>
                    <h3>Technologies</h3>
                    <p>(5100 jobs)</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12 f-category">
                <a href="browse-jobs.html">
                    <div class="icon bg-color-5">
                        <i class="lni-brush"></i>
                    </div>
                    <h3>Art/Design</h3>
                    <p>(5079 jobs)</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12 f-category">
                <a href="browse-jobs.html">
                    <div class="icon bg-color-6">
                        <i class="lni-heart"></i>
                    </div>
                    <h3>Healthcare</h3>
                    <p>(3235 jobs)</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12 f-category">
                <a href="browse-jobs.html">
                    <div class="icon bg-color-7">
                        <i class="lni-funnel"></i>
                    </div>
                    <h3>Science</h3>
                    <p>(1800 jobs)</p>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12 f-category">
                <a href="browse-jobs.html">
                    <div class="icon bg-color-8">
                        <i class="lni-cup"></i>
                    </div>
                    <h3>Food Services</h3>
                    <p>(4286 jobs)</p>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Category Section End -->

<!-- Featured Section Start -->
<section id="featured" class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Featured Jobs</h2>
            <p>Here is a list of most liked job ads.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="job-featured">
                    <div class="icon">
                        <img src="{{asset('img')}}/features/img1.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">Software Engineer</a></h3>
                        <p class="brand">MizTech</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="full-time">Full Time</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="job-featured">
                    <div class="icon">
                        <img src="{{asset('img')}}/features/img2.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">Graphic Designer</a></h3>
                        <p class="brand">Hunter Inc.</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="part-time">Part Time</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="job-featured">
                    <div class="icon">
                        <img src="{{asset('img')}}/features/img3.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">Managing Director</a></h3>
                        <p class="brand">MagNews</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="full-time">Full Time</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="job-featured">
                    <div class="icon">
                        <img src="{{asset('img')}}/features/img4.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">Software Engineer</a></h3>
                        <p class="brand">AmazeSoft</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="full-time">Full Time</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="job-featured">
                    <div class="icon">
                        <img src="{{asset('img')}}/features/img5.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">Graphic Designer</a></h3>
                        <p class="brand">Bingo</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="part-time">Part Time</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="job-featured">
                    <div class="icon">
                        <img src="{{asset('img')}}/features/img6.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">Managing Director</a></h3>
                        <p class="brand">MagNews</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="full-time">Full Time</span>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mt-4">
                <a href="job-page.html" class="btn btn-common">Browse All Jobs</a>
            </div>
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Browse jobs Section Start -->
<div id="browse-jobs" class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="text-wrapper">
                    <div>
                        <h3>7,000+ Jobs</h3>
                        <p>Search all the open positions. Read reviews on over 600,000 companies worldwide. The right
                            job is out there.</p>
                        <a class="btn btn-common" href="#">Search jobs</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="img-thumb">
                    <img class="img-fluid" src="{{asset('img')}}/search.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Browse jobs Section End -->

<!-- How It Work Section Start -->
<section class="how-it-works section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">How It Works?</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="work-process">
                    <span class="process-icon">
                        <i class="lni-user"></i>
                    </span>
                    <h4>Create an Account</h4>
                    <p>First step is to create a free account and fill out mandatory info about yourself. After that
                        you can either apply to a job or post a job ad yourself.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="work-process step-2">
                    <span class="process-icon">
                        <i class="lni-search"></i>
                    </span>
                    <h4>Search Jobs</h4>
                    <p>Search for a job and simply apply to it with a press of a button. Fill out necessary information
                        and the employer will receive your application. Everyime employer changes job status you'll get
                        notified.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="work-process step-3">
                    <span class="process-icon">
                        <i class="lni-cup"></i>
                    </span>
                    <h4>Post a Job</h4>
                    <p>Post a job yourself and wait for application. Choose the right person and get in touch about
                        details.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- How It Work Section End -->

<!-- Latest Section Start -->
<section id="latest-jobs" class="section bg-gray">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Latest Jobs</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="jobs-latest">
                    <div class="img-thumb">
                        <img src="{{asset('img')}}/features/img1.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">UX Designer</a></h3>
                        <p class="brand">MizTech</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="full-time">Full Time</span>
                    </div>
                    <div class="save-icon">
                        <a href="#"><i class="lni-heart-filled"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="jobs-latest">
                    <div class="img-thumb">
                        <img src="{{asset('img')}}/features/img2.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">UI Designer</a></h3>
                        <p class="brand">Hunter Inc.</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="part-time">Part Time</span>
                    </div>
                    <div class="save-icon">
                        <a href="#"><i class="lni-heart-filled"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="jobs-latest">
                    <div class="img-thumb">
                        <img src="{{asset('img')}}/features/img3.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">Web Developer</a></h3>
                        <p class="brand">MagNews</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="full-time">Full Time</span>
                    </div>
                    <div class="save-icon">
                        <a href="#"><i class="lni-heart-filled"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="jobs-latest">
                    <div class="img-thumb">
                        <img src="{{asset('img')}}/features/img4.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">UX Designer</a></h3>
                        <p class="brand">AmazeSoft</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="full-time">Full Time</span>
                    </div>
                    <div class="save-icon">
                        <a href="#"><i class="lni-heart-filled"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="jobs-latest">
                    <div class="img-thumb">
                        <img src="{{asset('img')}}/features/img5.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">Digital Marketer</a></h3>
                        <p class="brand">Bingo</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="part-time">Part Time</span>
                    </div>
                    <div class="save-icon">
                        <a href="#"><i class="lni-heart-filled"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="jobs-latest">
                    <div class="img-thumb">
                        <img src="{{asset('img')}}/features/img6.png" alt="">
                    </div>
                    <div class="content">
                        <h3><a href="job-details.html">Web Developer</a></h3>
                        <p class="brand">MagNews</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i> New York</span>
                            <span><i class="lni-user"></i>John Smith</span>
                        </div>
                        <span class="full-time">Full Time</span>
                    </div>
                    <div class="save-icon">
                        <a href="#"><i class="lni-heart-filled"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mt-4">
                <a href="job-page.html" class="btn btn-common">Browse All Jobs</a>
            </div>
        </div>
    </div>
</section>
<!-- Latest Section End -->

<!-- Testimonial Section Start -->
<section id="testimonial" class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Clients Review</h2>
            <p>Here's what are users have to say about our app.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div id="testimonials" class="touch-slider owl-carousel">
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="author">
                                <div class="img-thumb">
                                    <img src="{{asset('img')}}/testimonial/img1.png" alt="">
                                </div>
                            </div>
                            <div class="content-inner">
                                <p class="description">Aplikacija je jebeno dobra.</p>
                                <div class="author-info">
                                    <h2><a href="#">Jessica</a></h2>
                                    <span>Senior Accountant</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="author">
                                <div class="img-thumb">
                                    <img src="{{asset('img')}}/testimonial/img2.png" alt="">
                                </div>
                            </div>
                            <div class="content-inner">
                                <p class="description">Jebe mame.</p>
                                <div class="author-info">
                                    <h2><a href="#">John Doe</a></h2>
                                    <span>Project Menager</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="author">
                                <div class="img-thumb">
                                    <img src="{{asset('img')}}/testimonial/img3.png" alt="">
                                </div>
                            </div>
                            <div class="content-inner">
                                <p class="description">Dost dobro. I rate 9/11.</p>
                                <div class="author-info">
                                    <h2><a href="#">Helen</a></h2>
                                    <span>Engineer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Section End -->

<!-- Blog Section -->
<section id="blog" class="section">
    <!-- Container Starts -->
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Latest Posts</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-xs-12 blog-item">
                <!-- Blog Item Starts -->
                <div class="blog-item-wrapper">
                    <div class="blog-item-img">
                        <a href="single-post.html">
                            <img src="{{asset('img')}}/blog/img1.jpg" alt="">
                        </a>
                    </div>
                    <div class="blog-item-text">
                        <h3><a href="single-post.html">Tips to write an impressive resume online for beginner</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore praesentium asperiores ad
                            vitae.</p>
                    </div>
                    <a class="readmore" href="#">Read More</a>
                </div>
                <!-- Blog Item Wrapper Ends-->
            </div>

            <div class="col-lg-4 col-md-6 col-xs-12 blog-item">
                <!-- Blog Item Starts -->
                <div class="blog-item-wrapper">
                    <div class="blog-item-img">
                        <a href="single-post.html">
                            <img src="{{asset('img')}}/blog/img2.jpg" alt="">
                        </a>
                    </div>
                    <div class="blog-item-text">
                        <h3><a href="single-post.html">Let's explore 5 cool new features in JobBoard theme</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore praesentium asperiores ad
                            vitae.</p>
                    </div>
                    <a class="readmore" href="#">Read More</a>
                </div>
                <!-- Blog Item Wrapper Ends-->
            </div>

            <div class="col-lg-4 col-md-6 col-xs-12 blog-item">
                <!-- Blog Item Starts -->
                <div class="blog-item-wrapper">
                    <div class="blog-item-img">
                        <a href="single-post.html">
                            <img src="{{asset('img')}}/blog/img3.jpg" alt="">
                        </a>
                    </div>
                    <div class="blog-item-text">
                        <h3><a href="single-post.html">How to convince recruiters and get your dream job</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore praesentium asperiores ad
                            vitae.</p>
                    </div>
                    <a class="readmore" href="#">Read More</a>
                </div>
                <!-- Blog Item Wrapper Ends-->
            </div>
        </div>
    </div>
</section>
<!-- blog Section End -->

<!-- download Section Start -->
<section id="download" class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-xs-12">
                <div class="download-wrapper">
                    <div>
                        <div class="download-text">
                            <h4>App Coming Soon</h4>
                            <p>We are currently working on both the Android and iOS apps. Both coming soon in eary
                                2019.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-xs-12">
                <div class="download-thumb">
                    <img class="img-fluid" src="{{asset('img')}}/app.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- download Section Start -->




<!-- Go To Top Link -->
<a href="#" class="back-to-top">
    <i class="lni-arrow-up"></i>
</a>


<!-- Preloader -->
<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>
<!-- End Preloader -->

@stop

@section('js')
{{-- --}}
@stop
