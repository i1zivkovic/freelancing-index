@extends('layouts.frontend')

@section('title', 'Job Details')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')
<div class="">
    <div class="space-100">

        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6 col-xs-12">
                        <div class="breadcrumb-wrapper">
                            <div class="img-wrapper">
                                <img src="{{asset('img')}}/about/company-logo.png" alt="">
                            </div>
                            <div class="content">
                                <h3 class="product-title">{{$job->title}}</h3>
                                <p class="brand">{{$job->user->username}}</p>
                                <div class="tags">
                                    <span><i class="lni-map-marker"></i> {{$job->job_location_city}},
                                        {{$job->job_location_country}}</span>
                                    <span><i class="lni-calendar"></i> Posted
                                        {{\Carbon\Carbon::parse($job->created_at)->format('d/m/Y')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        <div class="month-price">
                            <span class="year">
                                @if ($job->is_per_hour)
                                /hour
                                @else
                                /project
                                @endif
                            </span>
                            <div class="price">{{$job->offer}}$</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Job Detail Section Start -->
        <div class="content">
        <section class="job-detail section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-8 col-md-12 col-xs-12">
                        <div class="content-area">
                            <h4>Job Description</h4>
                            <p>{{$job->description}}</p>
                            <h5>What You Need for this Position</h5>
                            <ul>
                                @foreach($job->job_skills as $jobSkill)
                                <li>- {{$jobSkill->name}}</li>
                                @endforeach
                            </ul>
                            <h5>Application Link</h5>
                            <a href="#!">http://google.com</a>
                            <hr>
                            <a href="#" class="btn btn-common">Apply to a job</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-xs-12">
                        <div class="sideber">
                            <div class="widghet">
                                <h3>Job Location</h3>
                                <div class="maps">
                                    <div id="map" class="map-full">
                                        <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{$job->job_location_city}}%2C%20c{{$job->job_location_country}}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="widghet">
                                <h3>Share This Job</h3>
                                <div class="share-job">
                                    <form method="post" class="subscribe-form">
                                        <div class="form-group">
                                            <input type="text" name="share_link" class="form-control" value="localhost:8000/jobs/{{$job->slug}}"
                                                style="color: #9a9a9a !important;">
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                    <div class="meta-tag">
                                        <span class="meta-part"><a href="#"><i class="lni-star"></i> Write a Review</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Job Detail Section End -->


         <!-- Start Content -->
        <div class="container">
            <div class="row">
                <!-- Start Blog Posts -->
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <!-- Start Comment Area -->
                    <div id="comments">
                        <h3>There are 5 comments on this post</h3>
                        <ol class="comments-list">
                            <li>
                                <div class="media">
                                    <div class="thumb-left">
                                        <a href="#">
                                            <img src="{{asset('img')}}/blog/user1.png" alt="">
                                        </a>
                                    </div>
                                    <div class="info-body">
                                        <h4 class="name">Roy Fisher</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia possimus
                                            dignissimos eveniet aliquid optio sit sint fugit dolorem autem placeat
                                            nostrum deleniti nulla error, dolores in dolorum illum, tempore,
                                            perferendis.</p>
                                        <span class="comment-date">Mar 02, 2016</span>
                                        <a href="#" class="reply-link">Reply</a>
                                    </div>
                                </div>

                            </li>
                            <li>
                                <div class="media">
                                    <div class="thumb-left">
                                        <a href="#">
                                            <img src="{{asset('img')}}/blog/user3.png" alt="">
                                        </a>
                                    </div>
                                    <div class="info-body">
                                        <h4 class="name">Nancy Watson</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia possimus
                                            dignissimos eveniet aliquid optio sit sint fugit dolorem autem placeat
                                            nostrum deleniti nulla error, dolores in dolorum illum, tempore,
                                            perferendis.</p>
                                        <span class="comment-date">Mar 02, 2016</span>
                                        <a href="#" class="reply-link">Reply</a>
                                    </div>
                                </div>
                            </li>
                        </ol>
                        <!-- Start Respond Form -->
                        <div id="respond">
                            <h2 class="respond-title">Leave a comment</h2>
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="author" class="form-control" name="author" type="text" value=""
                                                size="30" placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="email" class="form-control" name="author" type="text" value=""
                                                size="30" placeholder="Enter your email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="subject" class="form-control" name="author" type="text" value=""
                                                size="30" placeholder="Subject (optional)">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea id="comment" class="form-control" name="comment" cols="45" rows="8"
                                                placeholder="Here goes your comment"></textarea>
                                        </div>
                                        <button type="submit" id="submit" class="btn btn-common" style="margin-bottom: 50px;">Submit Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Respond Form -->

                    </div>
                </div>
            </div>
        </div>

            @include('includes.frontend.loaderAndArrow')


            @section('js')

            @stop
        </div>
    </div>
    @stop
