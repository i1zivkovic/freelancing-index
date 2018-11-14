@extends('layouts.frontend')

@section('title', 'Profile')
@section('description', "")

@section('css')
{{-- --}}

@stop

@section('content')

<!-- Start Content -->
<div class="section user-info">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center mb-5">
                <h3>Profile</h3>
            </div>


            <div class="col-lg-12 col-md-12 col-xs-12 mb-5">
                <div class="inner-box my-resume">
                    <div class="author-resume">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="thumb">
                                    <img class="img-fluid" src="{{asset('uploads')}}/{{$user->username}}/{{$user->userProfile->image_url}}"
                                        alt="PIC">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                                <div class="author-info">
                                    <h3>{{$user->userProfile->first_name}} {{$user->userProfile->last_name}}</h3>
                                    <p>
                                        @if($user->userProfile->gender)
                                        @if($user->userProfile->gender == 'm')
                                        <i class="fas fa-mars"></i> Male
                                        @else
                                        <i class="fas fa-venus"></i> Female
                                        @endif
                                        @else
                                        {{-- --}}
                                        @endif
                                    </p>
                                    <p>
                                        <i class="fas fa-birthday-cake"></i>
                                        {{\Carbon\Carbon::parse($user->userProfile->date_of_birth)->format('d/m/Y')}}

                                    </p>
                                    <p>
                                        <span><i class="lni-phone"></i> {{$user->userProfile->contact_number ?
                                            $user->userProfile->contact_number : 'No number added' }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="author-info">
                                    <p>&nbsp;</p>
                                    <p><i class="lni-user"></i> {{$user->username}}</p>
                                    <p class=""><i class="lni-envelope"></i> {{$user->email}}</p>
                                    <p class=""><i class="lni-link"></i>
                                        @if($user->userProfile->website_url)
                                        <a href="{{$user->userProfile->website_url}}" target="_blank">{{$user->userProfile->website_url}}</a>
                                        @else
                                        No website added
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if (Auth::id() != $user->id)
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 align-self-center">
                                <div class="author-info">
                                    <button class="btn {{$user->followers->contains('follower_id', Auth::id()) ?  'btn-danger' : 'btn-common'}} follow-unfollow"
                                        onclick="actOnFollowUnfollow(this)" data-id="{{$user->id}}"><i class="fas {{$user->followers->contains('follower_id', Auth::id()) ?  'fa-user-minus' : 'fa-user-plus'}} follow-unfollow-icon"></i></button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="rating item">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 mb-4">
                                <h3>Rating</h3>

                                @if($user->rating->count() != 0)
                                <i class="lni-star-filled"></i> {{round($user->rating->avg('rating'), 2)}} / 5
                                @else
                                <i class="lni-star-filled"></i> <i>Not rated yet.</i>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-3 mb-4">
                                <h3>Following</h3>
                                <i class="lni-users"></i> {{$user->following_count}}
                            </div>
                            <div class="col-sm-12 col-md-3 mb-4">
                                <h3>Followers</h3>
                                <i class="lni-users"></i> {{$user->followers_count}}
                            </div>
                        </div>

                    </div>
                    <div class="about-me item">
                        <h3>About Me</h3>
                        @if($user->userProfile->about_me)
                        <p>{{$user->userProfile->about_me}} </p>
                        @else
                        <i>No description added</i>
                        @endif
                    </div>
                    <div class="socials item">
                        <h3>Socials</h3>
                        @if($user->userSocial)
                        <div class="social-link">
                            @if($user->userSocial->twitter)
                            <a href="{{$user->userSocial->twitter}}" class="Twitter" target="_blank" title="Twitter"><i
                                    class="lni-twitter-filled"></i></a>
                            @endif
                            @if($user->userSocial->facebook)
                            <a href="{{$user->userSocial->facebook}}" class="facebook" target="_blank" title="Facebook"><i
                                    class="lni-facebook-filled"></i></a>
                            @endif
                            @if($user->userSocial->instagram)
                            <a href="{{$user->userSocial->instagram}}" class="instagram" target="_blank" title="Instagram"><i
                                    class="lni-instagram-filled"></i></a>
                            @endif
                            @if($user->userSocial->google_plus)
                            <a href="{{$user->userSocial->google_plus}}" class="google" target="_blank" title="Google+"><i
                                    class="lni-google-plus"></i></a>
                            @endif
                            @if($user->userSocial->linkedin)
                            <a href="{{$user->userSocial->linkedin}}" class="linkedin" target="_blank" title="LinkedIn"><i
                                    class="lni-linkedin"></i></a>
                            @endif
                            @if($user->userSocial->github)
                            <a href="{{$user->userSocial->github}}" class="github" target="_blank" title="GitHub"><i
                                    class="lni-github"></i></a>
                            @endif
                        </div>
                        @else
                        <i>No socials added</i>
                        @endif
                    </div>
                    <div class="skills item">
                        <h3>Skills</h3>
                        <p class="">
                            @if($user->userSkills->count() > 0)
                            @foreach($user->userSkills as $skill)
                            @if($loop->last)
                            {{$skill->name}}
                            @else
                            {{$skill->name}} -
                            @endif
                            @endforeach

                            @if(!$user->userSkills)
                            No skills added
                            @endif
                            @else
                            <i>No skills added</i>
                            @endif
                        </p>
                    </div>
                    <div class="work-experence item">
                        <h3>Work Experience</h3>
                        @if($user->userProfile->profileExperience->count() > 0)
                        @foreach($user->userProfile->profileExperience as $experience)
                        <h4>{{$experience->job_title}}</h4>
                        <h5>{{$experience->company_name}}</h5>
                        <p>
                            <span class="address">{{$experience->job_location_city ?
                                $experience->job_location_city: 'Unknown city'}} , {{$experience->job_location_country
                                ?
                                $experience->job_location_country: 'Unkown
                                country'}}</span>
                        </p>
                        <span class="date">
                            {{\Carbon\Carbon::parse($experience->start_date)->format('d/m/Y')}} -
                            @if($experience->end_date)
                            {{\Carbon\Carbon::parse($experience->end_date)->format('d/m/Y')}}
                            @else
                            <i>ongoing</i>
                            @endif</span>
                        <p>{{$experience->job_description}}</p>
                        <br>
                        @endforeach
                        @else
                        <i>No experiences added</i>
                        @endif

                    </div>
                    <div class="education item">

                        <h3>Education</h3>
                        @if($user->userProfile->profileEducation->count() > 0)
                        @foreach($user->userProfile->profileEducation as $education)
                        <h4> {{$education->institution_name}}</h4>
                        <p> {{$education->major}}</p>
                        <p>{{$education->degree}}</p>
                        <span class="date">
                            {{\Carbon\Carbon::parse($education->start_date)->format('d/m/Y')}} -
                            @if($education->end_date)
                            {{\Carbon\Carbon::parse($education->end_date)->format('d/m/Y')}}
                            @else
                            <i>ongoing</i>
                            @endif </span>
                        @endforeach
                        @else
                        <i>Not educations added</i>
                        @endif

                    </div>
                    <div class="location item">
                        <h3>Location</h3>
                        @if( $user->userLocation['city'] || $user->userLocation['country'] )
                        <div class="col-md-12">
                            <div id="conatiner-map">
                                <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{$user->userLocation->city}}%2{{$user->userLocation->country}}&t=&z=7&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            </div>
                        </div>
                        @else
                        <i>No location addded</i>
                        @endif
                    </div>
                    <div class="location item">
                        <h3>Contact User</h3>

                        @if(session()->has('success_email'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session()->get('success_email')}}
                        </div>
                        @endif

                        {!! Form::open(['method' => 'POST', 'route' => ['frontend.contactUser', $user->id],
                        'autocomplete' =>
                        'on','id' => 'sendMailForm', 'class' => 'form-ad']) !!}
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        id="contact_name" name="name" placeholder="Name" required value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input placeholder="Email" id="contact_email" type="email" class="form-control"
                                        {{ $errors->has('email') ? ' is-invalid' : '' }} name="email" required value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Subject" name="subject" id="contact_subject"
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
                                    <textarea class="form-control" id="contact_message" name="message" placeholder="Your Message"
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
            </div>
            {{-- MAIN CONTENT --}}




            @if(!$user_posts->isEmpty())
            <div class="col-sm-12 mt-5">



                <ul class="nav nav-tabs  mb-5" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                            aria-controls="posts" aria-selected="false">Posts ({{$user_posts->total()}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="jobs-tab" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs"
                            aria-selected="false">Jobs ({{$user_jobs->total()}})</a>
                    </li>
                </ul>

                {{-- ACCOUNT INFO BEGIN --}}
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                        <div class="row mb-5">
                            <div class="col-sm-12 text-center">
                                <h3>Recent Posts</h3>
                            </div>
                        </div>

                        <div class="infinite-scroll">
                            @foreach($user_posts as $post)
                            <div class="row mb-3">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 blog-item">
                                    <div class="blog-post">
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <h3 class="post-title"><a href="{{route('frontend.posts.show',['slug' => $post->slug])}}">{{$post->title}}</a></h3>
                                            <div class="meta">
                                                <span class="meta-part"><i class="lni-comments-alt"></i>
                                                    {{$post->post_comments_count}} Comments</span>
                                                <span class="meta-part"><i class="lni-heart-filled"></i>
                                                    {{$post->post_likes_count}} Likes</span>
                                                <span class="meta-part"><i class="lni-calendar"></i>{{$post->created_at->format('d/m/Y')}}</span>
                                            </div>
                                            <p>{{ str_limit($post->description, $limit = 300, $end = '...') }}</p>
                                            {{-- <a href="posts/{{$recentPost->slug}}" class="btn btn-common">Read More</a>
                                            --}}
                                        </div>
                                        <!-- Post Content -->
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Form::open(['route' => ['frontend.postExploreFilter'], 'role' => 'form',
                                    'autocomplete' => 'off',
                                    'files' => false, 'method' => 'get', 'id' => 'search-form']) !!}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 mb-3">
                                            <input type="hidden" class="form-control" placeholder="" name="user"
                                                value="{{$user->username}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <button type="submit" class="btn btn-common btn-block">See All</button>
                                        </div>
                                    </div>
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
                        <div class="row mb-5">
                            <div class="col-sm-12 text-center">
                                <h3>Recent Jobs</h3>
                            </div>
                        </div>

                        <div class="infinite-scroll2">
                            @foreach($user_jobs as $job)
                            <div class="job-listings mb-5">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        {{-- <div class="job-company-logo">
                                            <img class="img-fluid" src="{{asset('uploads')}}/{{$job->user->username}}/{{$job->user->userProfile->image_url}}"
                                                alt="PIC">
                                        </div> --}}
                                        <div class="job-details">
                                            <a href="{{route('frontend.jobs.show',['id' => $job->slug])}}">
                                                <h3>{{$job->title}}</h3>
                                            </a>
                                        </div>

                                        <hr>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-xs-12 text-left">
                                        <p>
                                            {{$job->description}}
                                        </p>
                                        <br>
                                        <div class="tag-list">
                                            @foreach($job->job_skills as $jobSkill)
                                            <span>{{$jobSkill->name}}</span>
                                            @endforeach
                                        </div>
                                        <br>
                                        <div class="category-list">
                                            @foreach($job->job_business_categories as $jobCategory)
                                            @if($loop->last)
                                            <span>{{$jobCategory->name}}</span>
                                            @else
                                            <span>{{$jobCategory->name}} - </span>
                                            @endif
                                            @endforeach
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-xs-12 text-center">

                                        <span class="btn-open">
                                            {{$job->offer}}€
                                            @if($job->is_per_hour)
                                            /h
                                            @else
                                            /project
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-xs-12 text-center">
                                        <div class="location">
                                            <i class="lni-map-marker"></i> {{$job->job_location_city}},
                                            {{$job->job_location_country}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-xs-12 text-center">
                                        <span class="btn-full-time">{{$job->job_comments_count}} <i class="lni-comments-alt"></i>&nbsp;
                                            &nbsp; {{$job->job_likes_count}} <i class="lni-heart"></i></span>
                                    </div>
                                    <div class="col-lg-1 col-md-4 col-xs-12 text-center">
                                        <span class="btn-full-time">{{$job->job_applications_count}} <i class="lni-pencil-alt"></i></span>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-xs-12 text-center">
                                        @if ($job->job_status->id == 3)
                                        <span class="btn-full-time text-danger"> {{$job->job_status->name}} </span>
                                        @elseif ($job->job_status->id == 1)
                                        <span class="btn-full-time text-primary"> {{$job->job_status->name}} </span>
                                        @elseif ($job->job_status->id == 4)
                                        <span class="btn-full-time text-info"> {{$job->job_status->name}} </span>
                                        @else
                                        <span class="btn-full-time text-success"> {{$job->job_status->name}} </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-xs-12 text-center">
                                        @if(Auth::user() && ($job->user_id == Auth::user()->id) && ($job->job_status_id
                                        != 2))
                                        <span class="btn-full-time"><a href="{{route('frontend.jobs.edit',['id' => $job->id])}}">
                                                <i class="lni-pencil"></i>
                                            </a></span>
                                        &nbsp;
                                        <span class="btn-full-time"><a href="#" class="delete-job text-danger" data-id="{{$job->id}}">
                                                <i class="lni-trash"></i>
                                            </a></span>
                                        @endif
                                    </div>
                                </div>
                                @if(session()->has('edit_error'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    {{session()->get('edit_error')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            </div>
                            @endforeach
                            <div class="row">
                                    <div class="col-sm-12">
                                        {!! Form::open(['route' => ['frontend.jobsFilter'], 'role' => 'form',
                                        'autocomplete' => 'off',
                                        'files' => false, 'method' => 'get', 'id' => 'search-form']) !!}
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 mb-3">
                                                    <input type="hidden" class="form-control" placeholder=""
                                            name="user" value="{{$user->username}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <button type="submit" class="btn btn-common btn-block">See All</button>
                                            </div>
                                        </div>
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif



        </div>
    </div>
</div>
<!-- End Content -->



@include('includes.frontend.loaderAndArrow')

@stop

@section('js')
{{-- --}}

{!!Html::script(asset('js/custom/community.js'))!!}
{!!Html::script(asset('js/custom/profile.js'))!!}



@stop
