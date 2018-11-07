@extends('layouts.frontend')

@section('title', 'Home')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')


<div class="">
    <div class="space-100">
        <!-- Header Section Start -->
        <header id="home" class="hero-area">

            <div class="container">
                <div class="row space-100">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="contents text-center">
                            <h1 class="head-title">Welcome to <span>THE</span><span>HUNT</span>!</h1>
                            <p>Are you a freelancer looking for a full-time job or maybe you want to earn some money by
                                doing something you're good at? <br>Maybe you're a recuriter that needs the right people to
                               do a job for you? <br>We got you covered!</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Apply Us Section Start -->
            <div id="apply">
                <div class="container-fulid">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12 no-padding">
                            <div class="recruiter item-box">
                                <div class="content-inner">
                                    <h5>I'm</h5>
                                    <h3>Recruiter</h3>
                                    <p>Post a job and tell us about your project. We'll quickly match you with <br> the
                                        right freelancers and you can choose the ones that suit you best.</p>
                                    <a href="{{route('frontend.jobs.create')}}" class="btn btn-border-filled">Post a
                                        Job</a>
                                </div>
                                <div class="img-thumb">
                                    <i class="lni-briefcase"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12 no-padding">
                            <div class="jobseeker item-box">
                                <div class="content-inner">
                                    <h5>I'm</h5>
                                    <h3>Freelancer!</h3>
                                    <p>Search through {{$jobCount}} jobs and apply to ones that suit your needs.<br>
                                        Click on the button to start searching.</p>
                                    <a href="{{route('frontend.jobs.index')}}" class="btn btn-border-filled">Browse
                                        Jobs</a>
                                </div>
                                <div class="img-thumb">
                                    <i class="lni-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Apply Us Section End -->
        </header>


        <!-- How It Work Section Start -->
        <section class="how-it-works section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">How It Works?</h2>
                    <p>Not sure where to start? Let us explain it in the easiest way.</p>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                        <div class="work-process">
                            <span class="process-icon">
                                <i class="lni-user"></i>
                            </span>
                            <h4>Create an Account</h4>
                            <p>First step is to create account.<br> Fill out necessary info so that
                                users or companies know a little more about you.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="work-process step-2">
                            <span class="process-icon">
                                <i class="lni-search"></i>
                            </span>
                            <h4>Search Jobs</h4>
                            <p>You can search jobs from our database and find the ones that you like.
                                Simply apply to the job, fill out a form and user/company will receive your
                                application.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="work-process step-3">
                            <span class="process-icon">
                                <i class="lni-briefcase"></i>
                            </span>
                            <h4>Post a job ad</h4>
                            <p>Create an ad for your job.<br>
                                After that you simply wait for users to apply and choose the right ones.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="work-process step-3">
                            <span class="process-icon">
                                <i class="lni-users"></i>
                            </span>
                            <h4>Connect with other users</h4>
                            <p> You can follow other users using this site. That way their posts will show up on your
                                feed and you can see all the posts they are willing to share.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Counter Section Start -->
        <section id="counter" class="section bg-gray">
            <div class="container">
                <div class="row">
                    <!-- Start counter -->
                    <div class="col-lg-3 col-md-6 col-xs-12">
                        <div class="counter-box">
                            <div class="icon"><i class="lni-briefcase"></i></div>
                            <div class="fact-count">
                                <h3><span class="counter">{{$jobCount}}</span></h3>
                                <p>Jobs Posted</p>
                            </div>
                        </div>
                    </div>
                    <!-- End counter -->
                    <!-- Start counter -->
                    <div class="col-lg-3 col-md-6 col-xs-12">
                        <div class="counter-box">
                            <div class="icon"><i class="lni-pencil-alt"></i></div>
                            <div class="fact-count">
                                <h3><span class="counter">{{$postCount}}</span></h3>
                                <p>Posts</p>
                            </div>
                        </div>
                    </div>
                    <!-- End counter -->
                    <!-- Start counter -->
                    <div class="col-lg-3 col-md-6 col-xs-12">
                        <div class="counter-box">
                            <div class="icon"><i class="lni-user"></i></div>
                            <div class="fact-count">
                                <h3><span class="counter">{{$userCount}}</span></h3>
                                <p>Users</p>
                            </div>
                        </div>
                    </div>
                    <!-- End counter -->
                    <!-- Start counter -->
                    <div class="col-lg-3 col-md-6 col-xs-12">
                        <div class="counter-box">
                            <div class="icon"><i class="lni-write"></i></div>
                            <div class="fact-count">
                                <h3><span class="counter">{{$jobApplicationCount}}</span></h3>
                                <p>Applications</p>
                            </div>
                        </div>
                    </div>
                    <!-- End counter -->
                </div>
            </div>
        </section>
        <!-- Counter Section End -->
        <!-- How It Work Section End -->
        <!-- Header Section End -->


        <!-- Listings Section Start -->
        <section id="job-listings" class="section bg-cyan">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Recent Job Post</h2>
                    <p>Choose from the latest job posts. It is updated everytime you load a page.</p>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        @foreach($recentJobs as $recentJob)
                        <a class="job-listings" href="{{route('frontend.jobs.show',['slug' => $recentJob->slug])}}">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="job-company-logo">
                                        <img class="img-fluid" src="{{asset('uploads')}}/{{$recentJob->user->username}}/{{$recentJob->user->userProfile->image_url}}" alt="PIC">
                                    </div>
                                    <div class="job-details">
                                        <h3>{{$recentJob->title}}</h3>
                                        <span class="company-neme">
                                            {{$recentJob->user->username}}
                                        </span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12 text-left">
                                    <p>
                                        {{ str_limit($recentJob->description, $limit = 300, $end = '...') }}
                                    </p>
                                    @if ($recentJob->job_skills->count() > 0)
                                    <br>
                                    <div class="tag-list">
                                        @foreach($recentJob->job_skills as $jobSkill)
                                        <span>{{$jobSkill->name}}</span>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if ($recentJob->job_business_categories->count() > 0)
                                    <br>
                                    <div class="category-list">
                                        @foreach($recentJob->job_business_categories as $jobCategory)
                                        @if($loop->last)
                                        <span>{{$jobCategory->name}}</span>
                                        @else
                                        <span>{{$jobCategory->name}} - </span>
                                        @endif
                                        @endforeach
                                    </div>
                                    @endif
                                    <hr>

                                </div>

                                <div class="col-lg-4 col-md-4 col-xs-12 text-center">
                                    <div class="location">
                                        <i class="lni-map-marker"></i>{{$recentJob->job_location_city}},
                                        {{$recentJob->job_location_country}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 text-center">
                                    <span class="btn-open">{{$recentJob->offer}}$
                                        @if($recentJob->is_per_hour)
                                        /h
                                        @else
                                        /project
                                        @endif
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 text-center">
                                    <span class="btn-full-time">{{$recentJob->job_comments_count}} <i class="lni-comments-alt"></i>
                                        {{$recentJob->job_likes_count}} <i class="lni-heart"></i></span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="col-12 text-center mt-4">
                        <a href="{{route('frontend.jobs.index')}}" class="btn btn-common">See all jobs</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Listings Section End -->




        <!-- Blog Section -->
        <section id="blog" class="section">
            <!-- Container Starts -->
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Latest Posts</h2>
                    <p>See what our users have been sharing. From posts, pictures or projects. You can like and comment
                        the ones you find interesting.</p>
                </div>
                <div class="row">

                    @foreach($recentPosts as $recentPost)

                    <div class="col-lg-4 col-md-6 col-xs-12 blog-item">
                        <div class="blog-post">
                            <!-- Post thumb -->
                            <div class="post-thumb">
                                <a href="#"><img class="img-fulid" src="{{asset('img')}}/blog/blog1.jpg" height="200px"
                                        alt=""></a>
                                <div class="hover-wrap">
                                </div>
                            </div>
                            <!-- End Post post-thumb -->

                            <!-- Post Content -->
                            <div class="post-content">
                                <h3 class="post-title"><a href="{{route('frontend.posts.show',['slug' => $recentPost->slug])}}">{{$recentPost->title}}</a></h3>
                                <div class="meta">
                                    <span class="meta-part"><a href="{{route('frontend.user.show',['slug' => $recentPost->user->slug])}}"><i
                                                class="lni-user"></i> {{$recentPost->user->username}}</a></span>
                                    <span class="meta-part"><i class="lni-comments-alt"></i>
                                        {{$recentPost->post_comments_count}} Comments</span>
                                    <span class="meta-part"><i class="lni-heart-filled"></i>
                                        {{$recentPost->post_likes_count}} Likes</span>
                                    <span class="meta-part"><i class="lni-calendar"></i>{{$recentPost->created_at->format('d/m/Y
                                        H:i:s')}}</span>
                                </div>
                                <p>{{ str_limit($recentPost->description, $limit = 100, $end = '...') }}</p>
                                {{-- <a href="posts/{{$recentPost->slug}}" class="btn btn-common">Read More</a> --}}
                            </div>
                            <!-- Post Content -->

                        </div>
                    </div>
                    @endforeach


                    <div class="col-12 text-center mt-4">
                        <a href="posts" class="btn btn-common">See all posts</a>
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
                                    <h4>Mobile apps coming soon!</h4>
                                    <p>We are currently in process of developing Android, iOS and Winows Phone apps.<br>
                                        Be sure to subscribe to our newsletter so that you know when they go live and
                                        can start using them.</p>
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


        @include('includes.frontend.loaderAndArrow')

        @stop

        @section('js')
        {{-- --}}
        @stop
