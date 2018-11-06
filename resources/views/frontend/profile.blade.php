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
            {{-- <div class="col-lg-4 col-md-12 col-xs-12">
                <div class="right-sideabr">
                    <h4>Profile</h4>
                    <ul class="list-item">
                        <li><a href="resume.html">Info</a></li>
                        <li><a href="bookmarked.html">Bookmarked Jobs</a></li>
                        <li><a href="bookmarked.html">Bookmarked Posts</a></li>
                        <li><a href="notifications.html">Notifications <span class="notinumber">2</span></a></li>
                        <li><a href="manage-applications.html">Manage Applications</a></li>
                        <li><a href="job-alerts.html">Job Alerts</a></li>
                        <li><a href="{{route('frontend.changePassword')}}">Change Password</a></li>
                        <li><a href="index.html">Sing Out</a></li>
                    </ul>
                </div>
            </div> --}}

            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="inner-box my-resume">
                    <div class="author-resume">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="thumb">
                                    <img src="{{asset('uploads')}}/{{$user->username}}/thumb/{{$user->userProfile->image_url}}"
                                        alt="Profile Image">
                                </div>
                                <div class="author-info">
                                    <h3>{{$user->userProfile->first_name}} {{$user->userProfile->last_name}}</h3>
                                    <p>
                                        @if($profile->gender == 'm')
                                        <i class="fas fa-mars"></i> Male
                                        @else
                                        <i class="fas fa-venus"></i> Female
                                        @endif
                                    </p>
                                    <p>
                                        <i class="fas fa-birthday-cake"></i>
                                        {{\Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y')}}

                                    </p>
                                    <p>
                                        <span class="address"><i class="lni-map-marker"></i>{{$user->userLocation ?
                                            $user->userLocation->city .', '. $user->userLocation->country: 'Unkown
                                            location'}}</span>
                                    </p>
                                    <p>
                                        <span><i class="lni-phone"></i> {{$user->userProfile->contact_number}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="author-info">
                                    <p>&nbsp;</p>
                                    <p><i class="lni-user"></i> {{$user->username}}</p>
                                    <p class=""><i class="lni-envelope"></i> {{$user->email}}</p>
                                    <p class=""><i class="lni-link"></i> <a href="{{$user->userProfile->website_url}}"
                                            target="_blank">{{$user->userProfile->website_url}}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="about-me item">
                        <h3>About Me</h3>
                        <p>{{$user->userProfile->about_me}} </p>
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
                        @endif
                    </div>
                    <div class="skills item">
                        <h3>Skills</h3>
                        <p class="">
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
                        </p>
                    </div>
                    <div class="work-experence item">
                        <h3>Work Experience</h3>
                        @foreach($profile->profileExperience as $experience)
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
                            {{\Carbon\Carbon::parse($experience->end_date)->format('d/m/Y')}}</span>
                        <p>{{$experience->job_description}}</p>
                        <br>
                        @endforeach

                    </div>
                    <div class="education item">

                        <h3>Education</h3>
                        @foreach($profile->profileEducation as $education)
                        <h4> {{$education->institution_name}}</h4>
                        <p> {{$education->major}}</p>
                        <p>{{$education->degree}}</p>
                        <span class="date">
                            {{\Carbon\Carbon::parse($education->start_date)->format('d/m/Y')}} -
                            {{\Carbon\Carbon::parse($education->end_date)->format('d/m/Y')}} </span>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
{{--
<section class="profile-tabs">
    <!-- Start Content -->
    <div class="container">
        <div class="row">

            <!-- Start Blog Posts -->
            <div class="col-lg-12 col-md-12 col-xs-12">
                <ul class="nav nav-tabs  mb-1" id="profile-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="portfolio-tab" data-toggle="tab" href="#portfolio" role="tab"
                            aria-controls="posts" aria-selected="false">Portfolio</a>
                    </li>
                </ul>
                <div class="tab-content" id="profile-tab-content">
                    <div class="tab-pane active" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">
                        <!-- Posts Section -->
                        <section id="blog" class="section">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-xs-12 blog-item">
                                    <div class="blog-post">
                                        <!-- Post thumb -->
                                        <div class="post-thumb">
                                            <a href="#"><img class="img-fulid" src="{{asset('img')}}/blog/blog1.jpg"
                                                    height="200px" alt=""></a>
                                            <div class="hover-wrap">
                                            </div>
                                        </div>
                                        <!-- End Post post-thumb -->

                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <h3 class="post-title"><a href="#!">Test title</a></h3>
                                            <div class="meta">
                                                <span class="meta-part"><a><i class="lni-user"></i> i1zivkovic</a></span>
                                                <span class="meta-part"><i class="lni-comments-alt"></i>
                                                    3 Comments</span>
                                                <span class="meta-part"><i class="lni-heart-filled"></i>
                                                    5 Likes</span>
                                                <span class="meta-part"><i class="lni-calendar"></i>21/7/2018</span>
                                            </div>
                                            <p>This is a test description</p>
                                        </div>
                                        <!-- Post Content -->

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-xs-12 blog-item">
                                    <div class="blog-post">
                                        <!-- Post thumb -->
                                        <div class="post-thumb">
                                            <a href="#"><img class="img-fulid" src="{{asset('img')}}/blog/blog1.jpg"
                                                    height="200px" alt=""></a>
                                            <div class="hover-wrap">
                                            </div>
                                        </div>
                                        <!-- End Post post-thumb -->

                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <h3 class="post-title"><a href="#!">Test title</a></h3>
                                            <div class="meta">
                                                <span class="meta-part"><a><i class="lni-user"></i> i1zivkovic</a></span>
                                                <span class="meta-part"><i class="lni-comments-alt"></i>
                                                    3 Comments</span>
                                                <span class="meta-part"><i class="lni-heart-filled"></i>
                                                    5 Likes</span>
                                                <span class="meta-part"><i class="lni-calendar"></i>21/7/2018</span>
                                            </div>
                                            <p>This is a test description</p>
                                        </div>
                                        <!-- Post Content -->

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-xs-12 blog-item">
                                    <div class="blog-post">
                                        <!-- Post thumb -->
                                        <div class="post-thumb">
                                            <a href="#"><img class="img-fulid" src="{{asset('img')}}/blog/blog1.jpg"
                                                    height="200px" alt=""></a>
                                            <div class="hover-wrap">
                                            </div>
                                        </div>
                                        <!-- End Post post-thumb -->

                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <h3 class="post-title"><a href="#!">Test title</a></h3>
                                            <div class="meta">
                                                <span class="meta-part"><a><i class="lni-user"></i> i1zivkovic</a></span>
                                                <span class="meta-part"><i class="lni-comments-alt"></i>
                                                    3 Comments</span>
                                                <span class="meta-part"><i class="lni-heart-filled"></i>
                                                    5 Likes</span>
                                                <span class="meta-part"><i class="lni-calendar"></i>21/7/2018</span>
                                            </div>
                                            <p>This is a test description</p>
                                        </div>
                                        <!-- Post Content -->

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <a href="#!" class="btn btn-common">See all posts</a>
                            </div>
                        </section>
                        <!-- blog Section End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</section> --}}


@include('includes.frontend.loaderAndArrow')

@stop

@section('js')
{{-- --}}
@stop
