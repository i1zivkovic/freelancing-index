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
                            <div class="price">{{$job->job_status->name}}</div>
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
                        <div class="col-lg-12 col-md-12 col-xs-12 mb-4">
                            <div class="content-area">
                                <h5>Job Description</h5>
                                <p>{{$job->description}}</p>
                                <h5>Skills required</h5>
                                <div class="tag-list">
                                    @if ($job->job_skills->count())

                                    @foreach($job->job_skills as $jobSkill)
                                    <span>{{$jobSkill->name}} </span>
                                    @endforeach
                                    @else
                                    <i>No skills required</i>
                                    @endif
                                </div>
                                <h5>Categories</h5>
                                <div class="category-list">
                                    @if ($job->job_business_categories->count())
                                    @foreach($job->job_business_categories as $jobCategory)
                                    @if($loop->last)
                                    <span>{{$jobCategory->name}}</span>
                                    @else
                                    <span>{{$jobCategory->name}} - </span>
                                    @endif
                                    @endforeach
                                    @else
                                    <i>No categories assigned</i>
                                    @endif
                                </div>
                                <h5>
                                    Attached file
                                </h5>
                                @if ($job->job_files)
                                <p id="file-info"> <a href="{{asset('uploads')}}/{{$job->user->username}}/{{$job->job_files->path}}"
                                        download>{{$job->job_files->path}}</a>
                                    @else
                                    <i>No files uploaded</i>
                                    @endif
                                    <h5>
                                        Offer
                                    </h5>
                                    <p class="offer">{{$job->offer}}$
                                        @if($job->is_per_hour)
                                        /hour
                                        @else
                                        /project
                                        @endif
                                    </p>
                                    @if(!Auth::user() || !($job->user_id == Auth::user()->id))
                                    <hr>
                                    <a href="#" class="btn btn-common">Apply to a job</a>
                                    @endif
                                    @if(Auth::user() && ($job->user_id == Auth::user()->id))
                                    <hr>
                                    <a href="{{route('frontend.jobs.edit',['id' => $job->id])}}">
                                        <i class="lni-pencil"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" class="delete-job" data-id="{{$job->id}}">
                                        <i class="lni-trash"></i>
                                    </a>
                                    @endif
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12">
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
                            <h3>There are {{$job->job_comments->count()}} comments on this post</h3>
                            <ol class="comments-list">
                                @foreach($job->job_comments as $job_comment)
                                <li id="row_{{$job_comment->id}}">
                                    <div class="media">
                                        <div class="thumb-left">
                                            <a href="#">
                                                <img src="{{asset('img')}}/blog/user1.png" alt="">
                                            </a>
                                        </div>
                                        <div class="info-body">
                                            <h4 class="name">{{$job_comment->username}}</h4>
                                            <p>{{$job_comment->comment}}</p>
                                            <form>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" placeholder="Enter email">
                                                </div>
                                            </form>
                                            <span class="comment-date">{{\Carbon\Carbon::parse($job_comment->created_at)->format('d/m/Y')}}</span>
                                            <hr>
                                            <a href="#">
                                                <i class="lni-pencil"></i>
                                            </a>
                                            &nbsp;
                                            <a href="#" class="delete-comment" data-id="{{$job_comment->id}}">
                                                <i class="lni-trash"></i>
                                            </a>
                                        </div>
                                    </div>

                                </li>
                                @endforeach
                            </ol>
                            <!-- Start Respond Form -->
                            <div id="respond" class="mb-5" <h2 class="respond-title">Leave a comment</h2>
                                {!! Form::open(['method' => 'POST', 'route' =>
                                ['frontend.job-comments.store'], 'autocomplete' =>
                                'on','id' => 'commentForm', 'class' => 'form-ad']) !!}
                                @csrf
                                <input type="hidden" value="{{$job->id}}" name="job_id">
                                <input type="hidden" value="{{$job->slug}}" name="job_slug">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                                name="comment" cols="45" rows="8" placeholder="Here goes your comment (1000 characters max.)"
                                                required>{{ old('comment') }}</textarea>
                                            @if ($errors->has('comment'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comment') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <button type="submit" id="submit" class="btn btn-common">Submit
                                            Comment</button>
                                    </div>
                                </div>
                                {!!Form::close()!!}
                            </div>
                            <!-- End Respond Form -->


                        </div>
                    </div>
                </div>
            </div>

            @include('includes.frontend.loaderAndArrow')


            @section('js')
            <!-- Focus comment input if there is an error -->

            {!!Html::script(asset('js/custom/job-details.js'))!!}

            @stop
        </div>
    </div>
    @stop
