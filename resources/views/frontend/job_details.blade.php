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
                                <img class="img-fluid" src="{{asset('uploads')}}/{{$job->user->username}}/{{$job->user->userProfile->image_url}}"
                                    alt="PIC">
                            </div>
                            <div class="content">
                                <h3 class="product-title">{{$job->title}}</h3>
                                <p class="brand"><a href="{{route('frontend.user.show',['slug' => $job->user->slug])}}">{{$job->user->username}}</a></p>
                                <div class="tags job-metadata">
                                    <span><i class="lni-map-marker"></i> {{$job->job_location_city}},
                                        {{$job->job_location_country}}</span>
                                    <span><i class="lni-calendar"></i> Posted
                                        {{\Carbon\Carbon::parse($job->created_at)->format('d/m/Y')}}
                                        @if($job->created_at != $job->updated_at)
                                        <small>- edited</small>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-xs-12">
                        @if($job->job_status_id == 1)
                        <div class="month-price bg-primary">
                            <div class="price ">{{$job->job_status->name}}</div>
                        </div>
                        @elseif($job->job_status_id == 2)
                        <div class="month-price">
                            <div class="price">{{$job->job_status->name}}</div>
                        </div>
                        @elseif($job->job_status_id == 4)
                        <div class="month-price bg-info">
                            <div class="price">{{$job->job_status->name}}</div>
                        </div>
                        @else
                        <div class="month-price bg-danger">
                            <div class="price">{{$job->job_status->name}}</div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Job Detail Section Start -->
        <div class="content">
            <section class="job-detail section">
                <div class="container">
                        @if(session()->has('edit_success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{session()->get('edit_success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                    <div class="row justify-content-between">

                        <div class="col-lg-8 col-md-12 col-xs-12 mb-4">

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
                                <p id="file-info"> <a href="{{asset('uploads')}}/{{$job->user->username}}/jobs/{{$job->id}}/{{$job->job_files->path}}"
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

                                    {{-- If user hasn't already applied, is not owner of the job and job status is
                                    'Active'--}}
                                    @if(($job->user_id != Auth::user()->id) &&
                                    !($job->job_applications->contains('user_id',Auth::id())) && $job->job_status_id ==
                                    1)
                                    <hr>
                                    <a class="btn btn-common" href="{{route('frontend.job-applications.show', ['id' => $job->id])}}">
                                        Apply
                                    </a>
                                    {{-- If user is owner of the job --}}
                                    @elseif ($job->user_id == Auth::user()->id)

                                    {{-- If user has already applied --}}
                                    @elseif ($job->job_applications->contains('user_id',Auth::user()->id))
                                    <hr>
                                    {!! Form::open(['method' => 'DELETE', 'route' =>
                                    ['frontend.job-applications.destroy', $job->id],'id' => 'removeApplicationForm',
                                    'class' => 'form-ad']) !!}
                                    @csrf
                                    <button type="submit" class="btn btn-common">Cancel Application</button>
                                    {!!Form::close()!!}
                                    @endif
                                    @if(Auth::user() && ($job->user_id == Auth::user()->id) && ($job->job_status->id != 2))
                                    <hr>
                                    <a href="{{route('frontend.jobs.edit',['id' => $job->id])}}">
                                        <i class="lni-pencil"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" class="delete-job text-danger" data-id="{{$job->id}}">
                                        <i class="lni-trash"></i>
                                    </a>
                                    @endif
                            </div>

                            @if(session()->has('edit_error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                {{session()->get('edit_error')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if(session()->has('successRemove'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{session()->get('successRemove')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-12 col-xs-12">
                            <div class="sideber">
                                <div class="widghet">
                                    <h3>Job Location</h3>
                                    <div class="maps">

                                        @if($job['job_location_city'] || $job['job_location_country'])
                                        <div id="map" class="map-full">
                                            <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{$job->job_location_city}}%2C%20c{{$job->job_location_country}}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                        </div>
                                        @else
                                        <i>No location added</i>
                                        @endif
                                    </div>
                                </div>
                                <div class="widghet">
                                    <h3>Share This Job</h3>
                                    <div class="share-job">
                                        <div class="form-group">
                                            <input type="text" name="share_link" class="form-control" value="http://localhost:8000/jobs/{{$job->slug}}"
                                                style="color: #9a9a9a !important;">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widghet">
                                    <h3>Like This Job</h3>
                                    <div class="">
                                        <div class="form-group">
                                            <a href="#!" onclick="actOnLikeUnlike(event);" data-id="{{$job->id}}" id="job-like-button">
                                                <i class="{{$job->job_likes->contains('user_id', Auth::id()) ? 'lni-heart-filled' : "lni-heart"}}"
                                                    id="job-like-action"></i>
                                            </a>
                                            <span id="job-likes-count">{{$job->job_likes_count}}</span>
                                            <div class="clearfix"></div>
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
                    <!-- Start Job Details-->
                    <div class="col-lg-12 col-md-12 col-xs-12">


                        <ul class="nav nav-tabs  mb-3" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="applications-tab" data-toggle="tab" href="#applications"
                                    role="tab" aria-controls="applications" aria-selected="false">Applications
                                    ({{$job->job_applications->count()}})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab"
                                    aria-controls="comments" aria-selected="true">Comments
                                    ({{$job->job_comments->count()}})</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            {{-- Comments --}}
                            <div class="tab-pane" id="comments" role="tabpanel" aria-labelledby="comments-tab">

                                <div id="comments">
                                    {{-- Start comment area --}}
                                    <ol class="comments-list">
                                        @foreach($job->job_comments as $job_comment)
                                        <li id="row_{{$job_comment->id}}">
                                            <div class="media">
                                                <div class="info-body">
                                                    <h4 class="name"><a href="{{route('frontend.user.show',['slug' => $job_comment->slug])}}">{{$job_comment->first_name}}
                                                            {{$job_comment->last_name}}</a></h4>
                                                    <p id="job_comment_{{$job_comment->id}}">{{$job_comment->comment}}</p>
                                                    <div id="comment_input_wrapper_{{$job_comment->id}}">
                                                    </div>
                                                    <span class="comment-date" id="job_comment_date_{{$job_comment->id}}">
                                                        {{\Carbon\Carbon::parse($job_comment->updated_at)->format('d/m/Y')}}
                                                        @if($job_comment->updated_at != $job_comment->created_at)
                                                        <small>- edited</small>
                                                        @endif
                                                    </span>
                                                    @if(Auth::user() && ($job_comment->user_id == Auth::user()->id))
                                                    <hr>
                                                    <div id="comment_actions_{{$job_comment->id}}">
                                                        <a href="#" class="edit-comment mr-1" data-id="{{$job_comment->id}}">
                                                            <i class="lni-pencil"></i>
                                                        </a>

                                                        <a href="#" class="delete-comment text-danger" data-id="{{$job_comment->id}}">
                                                            <i class="lni-trash"></i>
                                                        </a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </li>
                                        @endforeach
                                    </ol>
                                    {{-- End comment area --}}

                                    <!-- Start Respond Form -->
                                    <div id="respond" class="mb-5">
                                        <h2 class="respond-title">Leave a comment</h2>
                                        {!! Form::open(['method' => 'POST', 'route' =>
                                        ['frontend.job-comments.store'], 'autocomplete' =>
                                        'on','id' => 'commentForm', 'class' => 'form-ad']) !!}
                                        @csrf
                                        <input type="hidden" value="{{$job->id}}" name="job_id">
                                        <input type="hidden" value="{{$job->slug}}" name="job_slug">
                                        <input type="hidden" value="{{Auth::id()}}" name="user_id">
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
                            {{-- End comments --}}

                            {{-- Applications --}}
                            <div class="tab-pane active" id="applications" role="tabpanel" aria-labelledby="applications-tab">
                                <div class="mb-5">
                                    <div id="comments">
                                        <ol class="comments-list">
                                            @foreach($job->job_applications as $job_application)
                                            <li id="row_{{$job_application->id}}">
                                                <div class="media">
                                                    <div class="info-body">
                                                        <h4 class="name"><a href="{{route('frontend.user.show',['slug' => $job_application->slug])}}">{{$job_application->first_name}}
                                                                {{$job_application->last_name}}</a></h4>
                                                        <p>{{$job_application->comment}}</p>
                                                        <span class="comment-date">{{\Carbon\Carbon::parse($job_application->updated_at)->format('d/m/Y')}}</span>
                                                        @if(Auth::user() && ($job->user_id == Auth::user()->id) &&
                                                        ($job_application->job_application_state == 'Waiting'))
                                                        <hr>
                                                        <a href="#!" class="accept-application" onclick="actOnJobApplicationAction({{$job_application->id}}, 2, {{$job->id}})">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="#!" class="reject-application" onclick="actOnJobApplicationAction({{$job_application->id}}, 3, {{$job->id}})">
                                                            <i class="fas fa-times text-danger"></i>
                                                        </a>
                                                        @elseif (Auth::user() && ($job->user_id == Auth::user()->id) &&
                                                        ($job_application->job_application_state != 'Waiting'))
                                                        <hr>
                                                        <p>
                                                            {{$job_application->job_application_state}}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            {{-- End applications --}}
                        </div>
                    </div>
                    {{-- END JOB DETAILS --}}
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
