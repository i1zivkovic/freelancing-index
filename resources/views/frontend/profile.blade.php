@extends('layouts.frontend')

@section('title', 'Profile')
@section('description', "")

@section('css')
{{-- --}}
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
                                    @if($user->userSocial)
                                    <div class="social-link">
                                        @if($user->userSocial->twitter)
                                        <a href="{{$user->userSocial->twitter}}" class="Twitter" target="_blank" title="Twitter"><i
                                                class="lni-twitter-filled"></i></a>
                                        @endif
                                        @if($user->userSocial->facebook)
                                        <a href="{{$user->userSocial->facebook}}" class="facebook" target="_blank"
                                            title="Facebook"><i class="lni-facebook-filled"></i></a>
                                        @endif
                                        @if($user->userSocial->instagram)
                                        <a href="{{$user->userSocial->instagram}}" class="instagram" target="_blank"
                                            title="Instagram"><i class="lni-instagram-filled"></i></a>
                                        @endif
                                        @if($user->userSocial->google)
                                        <a href="{{$user->userSocial->google}}" class="google" target="_blank" title="Google+"><i
                                                class="lni-google-filled"></i></a>
                                        @endif
                                        @if($user->userSocial->linkedin)
                                        <a href="{{$user->userSocial->linkedin}}" class="linkedin" target="_blank"
                                            title="LinkedIn"><i class="lni-linkedin-filled"></i></a>
                                        @endif
                                        @if($user->userSocial->github)
                                        <a href="{{$user->userSocial->github}}" class="github" target="_blank" title="GitHub"><i
                                                class="lni-github"></i></a>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="author-info">
                                    <p>&nbsp;</p>
                                    <p><i class="lni-user"></i> {{$user->username}}</p>
                                    <p class=""><i class="lni-envelope"></i> {{$user->email}}</p>
                                    <p class=""><i class="lni-ruler-pencil"></i>
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
                    <div class="work-experence item">
                        <h3>Work Experience</h3>
                        @foreach($profile->profileExperience as $experience)
                        <h4>{{$experience->job_title}}</h4>
                        <h5>{{$experience->company_name}}</h5>
                        <p>
                            <span class="address"><i class="lni-map-marker"></i>{{$experience->job_location_city ?
                                $experience->job_location_city: 'Unknown city'}} , {{$experience->job_location_country ?
                                $experience->job_location_country: 'Unkown
                                country'}}</span>
                        </p>
                        <span class="date"><i class="lni-calendar"></i> {{\Carbon\Carbon::parse($experience->start_date)->format('d/m/Y')}} -
                            {{\Carbon\Carbon::parse($experience->end_date)->format('d/m/Y')}}</span>
                        <p>{{$experience->job_description}}</p>
                        <br>
                        @endforeach

                    </div>
                    <div class="education item">

                        <h3>Education</h3>
                        @foreach($profile->profileEducation as $education)
                        <h4> {{$education->institution_name}}</h4>
                        <p><i class="lni-book" title="Major"></i> {{$education->major}}</p>
                        <p><i class="lni-graduation" title="Degree"></i> {{$education->degree}}</p>
                        <span class="date"><i class="lni-calendar"></i>
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


@include('includes.frontend.loaderAndArrow')

@stop

@section('js')
{{-- --}}
@stop
