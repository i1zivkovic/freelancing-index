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


            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="inner-box my-resume">
                    <div class="author-resume">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="thumb">
                                    <img class="img-fluid" src="{{asset('uploads')}}/{{$user->username}}/{{$user->userProfile->image_url}}"
                                        alt="PIC">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

                                <div class="author-info">
                                    <h3>{{$user->userProfile->first_name}} {{$user->userProfile->last_name}}</h3>
                                    <p>
                                        @if($profile->gender)
                                        @if($profile->gender == 'm')
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
                                        {{\Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y')}}

                                    </p>
                                    <p>
                                        <span><i class="lni-phone"></i> {{$user->userProfile->contact_number ?
                                            $user->userProfile->contact_number : 'No number added' }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
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
                        @if($profile->profileExperience->count() > 0)
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
                        @if($profile->profileEducation->count() > 0)
                        @foreach($profile->profileEducation as $education)
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
                        @if( $user->userLocation['city']  ||  $user->userLocation['country'] )
                        <div class="col-md-12">
                            <div id="conatiner-map">
                                    <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{$user->userLocation->city}}%2{{$user->userLocation->country}}&t=&z=7&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            </div>
                        </div>
                        @else
                        <i>No location addded</i>
                        @endif
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
