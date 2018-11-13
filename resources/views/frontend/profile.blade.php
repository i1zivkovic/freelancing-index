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






            @if($user->rating->count() > 0)
            <div class="col-sm-12 mt-5">
                <!-- Testimonial Section Start -->
                <section id="testimonial" class="section box">
                    <div class="container">
                        <div class="section-header">
                            <h2 class="section-title">Recent Ratings</h2>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div id="testimonials" class="touch-slider owl-carousel">
                                    @foreach ($user->rating as $rating)
                                    @if($loop->index < 3) <div class="item">
                                        <div class="testimonial-item">
                                            <div class="author">
                                                <div class="img-thumb">
                                                    @if($rating->recruiter)
                                                    <img class="img-fluid" src="{{asset('uploads')}}/{{$rating->recruiter->username}}/{{$rating->recruiter->userProfile->image_url}}" alt="">
                                                    @else

                                                    @endif
                                                </div>

                                            </div>
                                                <div class="author-info">
                                                        @if($rating->recruiter)
                                                    <h6><a href="{{route('frontend.user.show',['slug' => $rating->recruiter->slug])}}">{{$rating->recruiter->userProfile->first_name}} {{$rating->recruiter->userProfile->first_name}}</a></h6>
                                                    @else
                                                    <h6><a href="#!"><i>Deleted user</i></a></h6>
                                                    @endif
                                                </div>
                                            <div class="content-inner">
                                                <p class="description">{{$rating->comment}}</p>
                                            <p class="rating"><i class="lni-star-filled"></i>{{$rating->rating}} / 5</p>
                                            </div>
                                        </div>
                                </div>

                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
            </section>
            <!-- Testimonial Section End -->
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
{!!Html::script(asset('js/custom/profile.js'))!!}
{!!Html::script(asset('js/custom/community.js'))!!}

@stop
