@extends('layouts.frontend')

@section('title', 'Edit Profile')
@section('description', "")

@section('css')
{{-- --}}

{!!Html::style(asset('css/select2.min.css'))!!}

@stop

@section('content')


<!-- Content section Start -->
<section id="content" class="profile-edit">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                <h5 class="mb-5">Edit your profile</h5>
            </div>



            <div class="col-lg-12 col-md-12 col-xs-12">
                <ul class="nav nav-tabs  mb-5" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{(session()->get('active-tab') == 'account-info' || !session()->get('active-tab')) ? 'active' : ''}}"
                            id="account-info-tab" data-toggle="tab" href="#account-info" role="tab" aria-controls="account-info"
                            aria-selected="false">Account Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{session()->get('active-tab') == 'profile-info' ? 'active' : ''}}" id="profile-info-tab"
                            data-toggle="tab" href="#profile-info" role="tab" aria-controls="profile-info"
                            aria-selected="true">Profile Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{session()->get('active-tab') == 'location-info' ? 'active' : ''}}" id="location-info-tab"
                            data-toggle="tab" href="#location-info" role="tab" aria-controls="location-info"
                            aria-selected="true">Location Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{session()->get('active-tab') == 'skills' ? 'active' : ''}}" id="skills-tab"
                            data-toggle="tab" href="#skills" role="tab" aria-controls="skills" aria-selected="true">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{session()->get('active-tab') == 'education' ? 'active' : ''}}" id="education-tab"
                            data-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="true">Education</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{session()->get('active-tab') == 'experiences' ? 'active' : ''}}" id="experiences-tab"
                            data-toggle="tab" href="#experiences" role="tab" aria-controls="experiences" aria-selected="true">Work
                            Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{session()->get('active-tab') == 'socials' ? 'active' : ''}}" id="socials-tab"
                            data-toggle="tab" href="#socials" role="tab" aria-controls="socials" aria-selected="true">Socials</a>
                    </li>

                </ul>

                {{-- ACCOUNT INFO BEGIN --}}
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane {{(session()->get('active-tab') == 'account-info' || !session()->get('active-tab')) ? 'active' : ''}} box"
                        id="account-info" role="tabpanel" aria-labelledby="account-info-tab">

                        @if(session()->has('account_success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session()->get('account_success')}}
                        </div>
                        @endif

                        {!! Form::open(['method' => 'POST', 'route' => ['frontend.accountInfo'],
                        'autocomplete'
                        =>
                        'off', 'files' => false, 'enctype' => 'multipart/form-data', 'id' => 'accountInfoForm', 'class'
                        =>
                        'form-ad','mb-3']) !!}
                        @csrf
                        <div class="row mb-3">
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <input type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        placeholder="" name="username" required value="{{Auth::user()->username}}">
                                    @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">E-mail</label>
                                    <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="" name="email" required value="{{Auth::user()->email}}">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="" name="password" value="">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="" name="password_confirmation" value="">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    {{ Form::checkbox('notify_applications', '1', Auth::user()->notify_applications) }}
                                    <label class="form-check-label" for="notify_applications">
                                        Notify applications (e-mail)
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    {{ Form::checkbox('notify_application_status', '1',
                                    Auth::user()->notify_application_status) }}
                                    <label class="form-check-label" for="notify_applications_status">
                                        Notify me about application status change
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-common">Update</button>
                        </div>
                        {!!Form::close()!!}

                    </div>
                    {{-- ACCOUNT INFO END --}}


                    {{-- PROFILE INFO BEGIN --}}
                    <div class="tab-pane box {{session()->get('active-tab') == 'profile-info' ? 'active' : ''}}" id="profile-info"
                        role="tabpanel" aria-labelledby="profile-info-tab">

                        @if(session()->has('profile_success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session()->get('profile_success')}}
                        </div>
                        @endif

                        {!! Form::open(['method' => 'POST', 'route' => ['frontend.profileInfo'],
                        'autocomplete'
                        =>
                        'off', 'files' => false, 'enctype' => 'multipart/form-data', 'id' => 'profileInfoForm', 'class'
                        =>
                        'form-ad','mb-3']) !!}
                        @csrf
                        <input type="hidden" value="{{$user->userProfile->id}}" name="profile_id" />
                        <div class="row mb-3">
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                        placeholder="" name="first_name" required value="{{$user->userProfile->first_name}}">
                                    @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                        placeholder="" name="last_name" required value="{{$user->userProfile->last_name}}">
                                    @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Date of birth</label>
                                    <input type="date" class="form-control {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}"
                                        placeholder="" name="date_of_birth" required value="{{$user->userProfile->date_of_birth}}">
                                    @if ($errors->has('date_of_birth'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Gender</label>
                                    <div class="search-category-container post-job">
                                        <label class="styled-select">
                                            {!! Form::select('gender', ['m' => 'Male', 'f' => 'Female'],
                                            $user->userProfile->gender, ['class' => 'dropdown-product selectpicker']) !!}
                                        </label>
                                        @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Website URL</label>
                                    <input type="text" class="form-control {{ $errors->has('website_url') ? ' is-invalid' : '' }}"
                                        placeholder="" name="website_url" required value="{{$user->userProfile->website_url}}">
                                    @if ($errors->has('website_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('website_url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Contact number</label>
                                    <input type="text" class="form-control {{ $errors->has('contact_number') ? ' is-invalid' : '' }}"
                                        placeholder="" name="contact_number" required value="{{$user->userProfile->contact_number}}">
                                    @if ($errors->has('contact_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="control-label">About me</label>
                                    <textarea name="about_me" cols="30" rows="10" class="form-control {{ $errors->has('about_me') ? ' is-invalid' : '' }}">{{$user->userProfile->about_me}}</textarea>
                                    @if ($errors->has('about_me'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('about_me') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group">
                                    <label class="control-label">Choose a profile image</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="image_url" name="image_url"
                                            value="{{old('image_url')}}">
                                        <label class="custom-file-label form-control {{ $errors->has('image_url') ? ' is-invalid' : '' }}" for="file" id="image_url_label">Choose
                                            profile
                                            image...</label>
                                        @if($errors->has('image_url'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_url') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-common">Update</button>
                        </div>
                        {!!Form::close()!!}
                    </div>
                    {{-- PROFILE INFO END --}}

                    {{-- LOCATION INFO BEGIN --}}
                    <div class="tab-pane box {{session()->get('active-tab') == 'location-info' ? 'active' : ''}}" id="location-info"
                        role="tabpanel" aria-labelledby="location-info-tab">

                        @if(session()->has('location_success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session()->get('location_success')}}
                        </div>
                        @endif

                        {!! Form::open(['method' => 'POST', 'route' => ['frontend.locationInfo'],
                        'autocomplete'
                        =>
                        'off', 'files' => false, 'enctype' => 'multipart/form-data', 'id' => 'locationInfoForm',
                        'class'
                        =>
                        'form-ad','mb-3']) !!}
                        @csrf
                        <div class="row mb-3">

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input type="text" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}"
                                        placeholder="" name="city" value="{{$user->userLocation ? $user->userLocation->city : null }}">
                                    @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                    <input type="text" class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}"
                                        placeholder="" name="country" value="{{$user->userLocation ? $user->userLocation->country : null }}">
                                    @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-common">Update</button>
                        </div>
                        {!!Form::close()!!}
                    </div>
                    {{-- LOCATION INFO END --}}


                    {{-- SKILLS BEGIN --}}
                    <div class="tab-pane box {{session()->get('active-tab') == 'skills' ? 'active' : ''}}" id="skills"
                        role="tabpanel" aria-labelledby="skills-tab">

                        @if(session()->has('skills_success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session()->get('skills_success')}}
                        </div>
                        @endif

                        <div class="post-job">
                            {!! Form::open(['method' => 'POST', 'route' => ['frontend.skillsInfo'],
                            'autocomplete'
                            => 'on', 'enctype' => 'multipart/form-data', 'id' => 'skillsForm',
                            'class' => 'form-ad']) !!}
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Skills</label>
                                        <label class="styled-select">
                                            {!! Form::select('skill_list[]', $skills, $selectedSkills,
                                            ['class' => 'dropdown-product selectpicker', 'multiple' => true, 'id' =>
                                            'skill_list']) !!}
                                        </label>
                                    </div>
                                    <div class="col-xs-12 text-center">
                                        <button type="submit" class="btn btn-common">Update</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {!!Form::close()!!}


                    </div>
                    {{-- SKILLS END --}}





                    {{-- EDUCATION BEGIN --}}
                    <div class="tab-pane box {{session()->get('active-tab') == 'education' ? 'active' : ''}}" id="education"
                        role="tabpanel" aria-labelledby="education-tab">

                        @if(session()->has('education_success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session()->get('education_success')}}
                        </div>
                        @endif

                        {!! Form::open(['method' => 'POST', 'route' => ['frontend.profileEducation'],
                        'autocomplete'
                        =>
                        'off', 'files' => false, 'enctype' => 'multipart/form-data', 'id' => 'profileEducationForm',
                        'class' =>
                        'form-ad','mb-3']) !!}
                        @csrf
                        <input type="hidden" value="{{$user->userProfile->id}}" name="profile_id" />
                        <div class="education-entry">
                            @if(empty(old('institution_name')))
                            @if(!empty($user->userProfile->profileEducation))
                            @foreach($user->userProfile->profileEducation as $user->userProfile_education)
                            <div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Institution Name</label>
                                        <input type="text" class="form-control" placeholder="" name="institution_name[]"
                                            required value="{{$user->userProfile_education->institution_name}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Major</label>
                                        <input type="text" class="form-control" placeholder="" name="major[]" required
                                            value="{{$user->userProfile_education->major}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="control-label">Degree</label>
                                        <input type="text" class="form-control" placeholder="" name="degree[]" required
                                            value="{{$user->userProfile_education->degree}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea name="description[]" cols="30" rows="7" class="form-control">{{$user->userProfile_education->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <input type="date" class="form-control" placeholder="" name="start_date[]"
                                            value="{{$user->userProfile_education->start_date}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input type="date" class="form-control" placeholder="" name="end_date[]" value="{{$user->userProfile_education->end_date}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="add-post-btn">
                                        <a href="#!" class="btn-delete remove-education">Remove</a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @else
                            @foreach(old('institution_name') as $key => $institution_name)
                            <div class="row mb-3">
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Institution Name</label>
                                        <input type="text" class="form-control {{$errors->has('institution_name.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="institution_name[]" required value="{{$institution_name}}">
                                        @if ($errors->has('institution_name.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('institution_name.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Major</label>
                                        <input type="text" class="form-control {{$errors->has('major.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="major[]" required value="{{old('major.'.$key)}}">
                                        @if ($errors->has('major.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('major.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="control-label">Degree</label>
                                        <input type="text" class="form-control {{$errors->has('degree.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="degree[]" required value="{{old('degree.'.$key)}}">
                                        @if ($errors->has('degree.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('degree.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea name="description[]" cols="30" rows="7" class="form-control {{$errors->has('description.'.$key) ? 'is-invalid' : ''}}">{{old('description.'.$key)}}</textarea>
                                        @if ($errors->has('description.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <input type="date" class="form-control {{$errors->has('start_date.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="start_date[]" value="{{old('start_date.'.$key)}}">
                                        @if ($errors->has('start_date.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start_date.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input type="date" class="form-control {{$errors->has('end_date.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="end_date[]" value="{{old('end_date.'.$key)}}">
                                        @if ($errors->has('end_date.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end_date.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="add-post-btn">
                                        <a href="#!" class="btn-delete remove-education">Remove</a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            {{-- row mb5 --}}
                        </div>
                        {{-- educations --}}
                        <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center mb-5">
                            <div class="add-post-btn">
                                <a href="#!" class="btn-added" id="add-education">Add New Education</a>
                            </div>
                        </div>

                        <div class="col-xs-12 text-center">
                            <button class="btn btn-common" type="submit" id="submit-education"
                                {{($user->userProfile->profileEducation->count() || !empty(old('institution_name'))) ? '' : 'disabled'}}>
                                Update</button>
                        </div>
                        {!!Form::close()!!}


                    </div>
                    {{-- EDUCATION END--}}





                    {{-- EXPERIENCE BEGIN --}}
                    <div class="tab-pane box {{session()->get('active-tab') == 'experiences' ? 'active' : ''}}" id="experiences"
                        role="tabpanel" aria-labelledby="experiences-tab">

                        @if(session()->has('experience_success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session()->get('experience_success')}}
                        </div>
                        @endif

                        {!! Form::open(['method' => 'POST', 'route' => ['frontend.profileExperience'],
                        'autocomplete'
                        =>
                        'off', 'files' => false, 'enctype' => 'multipart/form-data', 'id' => 'profileExperienceForm',
                        'class' =>
                        'form-ad','mb-3']) !!}
                        @csrf
                        <input type="hidden" value="{{$user->userProfile->id}}" name="profile_id" />
                        <div class="experience-entry">
                            @if(empty(old('company_name')))
                            @if(!empty($user->userProfile->profileExperience))
                            @foreach($user->userProfile->profileExperience as $user->userProfile_experience)
                            <div class="row mb-3">
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12  mb-3">
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Company Name</label>
                                        <input type="text" class="form-control" placeholder="" name="company_name[]"
                                            required value="{{$user->userProfile_experience->company_name}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Job Title</label>
                                        <input type="text" class="form-control" placeholder="" name="job_title[]"
                                            required value="{{$user->userProfile_experience->job_title}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="control-label">Job Description</label>
                                        <textarea name="job_description[]" cols="30" rows="7" class="form-control"
                                            required>{{$user->userProfile_experience->job_description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <input type="text" class="form-control" placeholder="" name="job_location_country[]"
                                            value="{{$user->userProfile_experience->job_location_country}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" class="form-control" placeholder="" name="job_location_city[]"
                                            value="{{$user->userProfile_experience->job_location_city}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <input type="date" class="form-control" placeholder="" name="start_date[]"
                                            value="{{$user->userProfile_experience->start_date}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input type="date" class="form-control" placeholder="" name="end_date[]" value="{{$user->userProfile_experience->end_date}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="add-post-btn">
                                        <a href="#!" class="btn-delete remove-experience">Remove</a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @else
                            @foreach(old('company_name') as $key => $company_name)
                            <div class="row mb-3">
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12  mb-3">
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Company Name</label>
                                        <input type="text" class="form-control {{$errors->has('company_name.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="company_name[]" required value="{{$company_name}}">
                                        @if ($errors->has('company_name.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company_name.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Job Title</label>
                                        <input type="text" class="form-control {{$errors->has('job_title.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="job_title[]" required value="{{old('job_title.'.$key)}}">
                                        @if ($errors->has('job_title.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('job_title.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="control-label">Job Description</label>
                                        <textarea name="job_description[]" cols="30" rows="7" class="form-control {{$errors->has('job_description.'.$key) ? 'is-invalid' : ''}}"
                                            required>{{old('job_description.'.$key)}}</textarea>
                                        @if ($errors->has('job_description.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('job_description.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <input type="text" class="form-control {{$errors->has('job_location_country.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="job_location_country[]" value="{{old('job_location_country.'.$key)}}">
                                        @if ($errors->has('job_location_country.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('job_location_country.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" class="form-control {{$errors->has('job_location_city.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="job_location_city[]" value="{{old('job_location_city.'.$key)}}">
                                        @if ($errors->has('job_location_city.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('job_location_city.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <input type="date" class="form-control {{$errors->has('start_date.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="start_date[]" value="{{old('start_date.'.$key)}}">
                                        @if ($errors->has('start_date.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start_date.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input type="date" class="form-control {{$errors->has('end_date.'.$key) ? 'is-invalid' : ''}}"
                                            placeholder="" name="end_date[]" value="{{old('end_date.'.$key)}}">
                                        @if ($errors->has('end_date.'.$key))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end_date.'.$key) }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="add-post-btn">
                                        <a href="#!" class="btn-delete remove-experience">Remove</a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            {{-- row mb5 --}}
                        </div>
                        {{-- experiences --}}
                        <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center mb-5">
                            <div class="add-post-btn">
                                <a href="#!" class="btn-added" id="add-experience">Add New Experience</a>
                            </div>
                        </div>

                        <div class="col-xs-12 text-center">
                            <button class="btn btn-common" type="submit" id="submit-experience"
                                {{($user->userProfile->profileExperience->count() || !empty(old('company_name'))) ? '' : 'disabled'}}>
                                Update</button>
                        </div>

                        {{-- {{dd(old('company_name'))}} --}}
                        {!!Form::close()!!}
                    </div>
                    {{-- EXPERIENCE END --}}



                    {{-- SOCIALS --}}
                    <div class="tab-pane {{(session()->get('active-tab') == 'socials') ? 'active' : ''}} box" id="socials"
                        role="tabpanel" aria-labelledby="socials-tab">

                        @if(session()->has('socials_success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session()->get('socials_success')}}
                        </div>
                        @endif

                        {!! Form::open(['method' => 'POST', 'route' => ['frontend.socialsInfo'],
                        'autocomplete'
                        =>
                        'off', 'files' => false, 'enctype' => 'multipart/form-data', 'id' => 'socialsInfoForm', 'class'
                        =>
                        'form-ad','mb-3']) !!}
                        @csrf
                        <div class="row mb-3">
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="lni-instagram"></i></span>
                                    </div>
                                    <input type="text" name="instagram" class="form-control" placeholder="instagram"
                                        aria-label="instagram" aria-describedby="basic-addon1" value="{{Auth::user()->userSocial ?   Auth::user()->userSocial->instagram : '' }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="lni-github"></i></span>
                                    </div>
                                    <input type="text" name="github" class="form-control" placeholder="github"
                                        aria-label="github" aria-describedby="basic-addon1" value="{{Auth::user()->userSocial ? Auth::user()->userSocial->github : '' }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="lni-linkedin"></i></span>
                                    </div>
                                    <input type="text" name="linkedin" class="form-control" placeholder="linkedin"
                                        aria-label="linkedin" aria-describedby="basic-addon1" value="{{Auth::user()->userSocial ? Auth::user()->userSocial->linkedin : '' }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="lni-facebook"></i></span>
                                    </div>
                                    <input type="text" name="facebook" class="form-control" placeholder="facebook"
                                        aria-label="facebook" aria-describedby="basic-addon1" value="{{Auth::user()->userSocial ? Auth::user()->userSocial->facebook : '' }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="lni-twitter"></i></span>
                                    </div>
                                    <input type="text" name="twitter" class="form-control" placeholder="twitter"
                                        aria-label="twitter" aria-describedby="basic-addon1" value="{{Auth::user()->userSocial ? Auth::user()->userSocial->twitter : '' }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="lni-google-plus"></i></span>
                                    </div>
                                    <input type="text" name="google_plus" class="form-control" placeholder="google_plus"
                                        aria-label="google_plus" aria-describedby="basic-addon1" value="{{Auth::user()->userSocial ? Auth::user()->userSocial->google_plus : '' }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-common">Update</button>
                        </div>
                        {!!Form::close()!!}
                    </div>
                    {{-- SOCIALS --}}




                </div>
                {{-- tab content --}}
            </div>
            {{-- col12 --}}

</section>
<!-- Content section End -->


@include('includes.frontend.loaderAndArrow')

@stop

@section('js')
{{-- --}}
{!!Html::script(asset('js/select2.min.js'))!!}
{!!Html::script(asset('js/custom/profile-edit.js'))!!}

@stop
