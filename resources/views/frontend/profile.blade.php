@extends('layouts.frontend')

@section('title', 'Profile')
@section('description', "")

@section('css')
{{--  --}}
@stop

@section('content')

 <!-- Start Content -->
 <div class="section">
    <div class="container">
        <div class="row">
        {{-- <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="right-sideabr">
            <h4>Manage profile</h4>
            <ul class="list-item">
                <li><a class="active" href="resume.html">My profile</a></li>
                <li><a href="notifications.html">Notifications <span class="notinumber">2</span></a></li>
                <li><a href="manage-applications.html">Job Applications</a></li>
                <li><a href="job-alerts.html">Job Alerts</a></li>
                <li><a href="change-password.html">Change Password</a></li>
            </ul>
            </div>
        </div> --}}
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="inner-box my-resume">
            <div class="author-resume">
                <div class="row">
                    <div class="col-md-6">
                        <div class="thumb">
                            <img src="{{asset('uploads')}}/{{$user->username}}/thumb/{{$user->userProfile->image_url}}" alt="Profile Image">
                        </div>
                        <div class="author-info">
                        <h3>{{$user->userProfile->first_name}} {{$user->userProfile->last_name}}</h3>
                        <p>
                        <span class="address"><i class="lni-map-marker"></i>{{$user->userLocation ? $user->userLocation->city .', '. $user->userLocation->country: 'Unkown location'}}</span>
                        </p>
                        <p>
                        <span><i class="lni-phone"></i> {{$user->userProfile->contact_number}}</span>
                        </p>
                        @if($user->userSocial)
                        <div class="social-link">
                            @if($user->userSocial->twitter)
                            <a href="{{$user->userSocial->twitter}}" class="Twitter" target="_blank"><i class="lni-twitter-filled"></i></a>
                            @endif
                            @if($user->userSocial->facebook)
                            <a href="{{$user->userSocial->facebook}}" class="facebook" target="_blank"><i class="lni-facebook-filled"></i></a>
                            @endif
                            @if($user->userSocial->instagram)
                            <a href="{{$user->userSocial->instagram}}" class="instagram" target="_blank"><i class="lni-instagram-filled"></i></a>
                            @endif
                            @if($user->userSocial->google)
                            <a href="{{$user->userSocial->google}}" class="google" target="_blank"><i class="lni-google-filled"></i></a>
                            @endif
                            @if($user->userSocial->linkedin)
                            <a href="{{$user->userSocial->linkedin}}" class="linkedin" target="_blank"><i class="lni-linkedin-filled"></i></a>
                            @endif
                            @if($user->userSocial->github)
                            <a href="{{$user->userSocial->github}}" class="github" target="_blank"><i class="lni-github"></i></a>
                            @endif
                        </div>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p><i class="lni-envelope"></i> {{$user->email}}</p>
                        <p class="mt-2"><i class="lni-briefcase"></i>
                        @foreach($user->userSkills as $skill)
                            @if($loop->last)
                            {{$skill->name}}
                            @else
                            {{$skill->name}},
                            @endif
                        @endforeach

                        @if(!$user->userSkills)
                        No skills added
                        @endif
                        </p>
                        <p class="mt-2"><i class="lni-link"></i> <a href="{{$user->userProfile->website_url}}" target="_blank">{{$user->userProfile->website_url}}</a></p>
                    </div>
                </div>
            </div>
            <div class="about-me item">
                <h3>About Me</h3>
                <p>{{$user->userProfile->about_me}} </p>
            </div>
            <div class="work-experence item">
                <h3>Work Experience</h3>
                <h4>UI/UX Designer</h4>
                <h5>Bannana INC.</h5>
                <span class="date">Fab 2017-Present(5year)</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero vero, dolores, officia quibusdam architecto sapiente eos voluptas odit ab veniam porro quae possimus itaque, quas! Tempora sequi nobis, atque incidunt!</p>
                <p><a href="#">4 Projects</a></p>
                <br>
                <h4>UI Designer</h4>
                <h5>Whale Creative</h5>
                <span class="date">Fab 2017-Present(2year)</span>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero vero, dolores, officia quibusdam architecto sapiente eos voluptas odit ab veniam porro quae possimus itaque, quas! Tempora sequi nobis, atque incidunt!</p>
                <p><a href="#">4 Projects</a></p>
            </div>
            <div class="education item">
                <h3>Education</h3>
                <h4>Massachusetts Institute Of Technology</h4>
                <p>Bachelor of Computer Science</p>
                <span class="date">2010-2014</span>
                <br>
                <h4>Massachusetts Institute Of Technology</h4>
                <p>Bachelor of Computer Science</p>
                <span class="date">2010-2014</span>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- End Content -->

@stop

@section('js')
{{--  --}}
@stop

