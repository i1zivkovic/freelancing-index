@extends('layouts.frontend')

@section('title', 'Step One')
@section('description', "")

@section('css')
{{--  --}}
@stop

@section('content')


  <!-- Content section Start -->
  <section id="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
              <div class="post-job box">
                {!! Form::open(['method' => 'POST', 'route' => ['frontend.postStepOne'], 'autocomplete' => 'on', 'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'postForm', 'class' => 'form-ad']) !!}
                @csrf
                  <h3>Basic information</h3>
                  <div class="form-group">
                    <label class="control-label">Gender</label>
                    <div class="search-category-container">
                        <label class="styled-select">
                        <select class="dropdown-product selectpicker" name="gender" value="old('gender')">
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                        </label>
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="control-label">First name</label>
                  <input type="text" class="form-control" placeholder="John" name="first_name" value="{{old('first_name')}}">
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">Last name</label>
                    <input type="text" class="form-control" placeholder="Doe" name="last_name" value="{{old('last_name')}}">
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                 </div>
                  <div class="form-group">
                    <label class="control-label">Date of birth</label>
                    <input type="date" class="form-control" placeholder="mm/dd/YYYY" name="date_of_birth" value="{{old('date_of_birth')}}">
                    @if ($errors->has('date_of_birth'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label class="control-label">About me</label>
                    <textarea class="form-control" placeholder="Describe yourself or your work" name="about_me" value="{{old('about_me')}}" rows="7"></textarea>
                    @if ($errors->has('about_me'))
                        <span class="help-block">
                            <strong>{{ $errors->first('about_me') }}</strong>
                        </span>
                    @endif
                 </div>
                 <div class="form-group">
                    <label class="control-label">Website</label>
                    <input type="text" class="form-control" placeholder="mywebsite.com" name="website_url" value="{{old('website_url')}}">
                    @if ($errors->has('website_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('website_url') }}</strong>
                        </span>
                    @endif
                 </div>
                 <div class="form-group">
                    <label class="control-label">Contact number</label>
                    <input type="text" class="form-control" placeholder="e.g. 03485934020" name="contact_number" value="{{old('contact_number')}}">
                    @if ($errors->has('contact_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('contact_number') }}</strong>
                        </span>
                    @endif
                 </div>
                  <div class="form-group">
                    <div class="button-group">
                      <div class="action-buttons">
                        <div class="upload-button">
                          <button class="btn btn-common">Choose a profile image</button>
                        <input id="image" type="file" name="image" value="{{old('image')}}">
                        </div>
                        @if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>
                <button type="submit" class="btn btn-common">Next</button>
                {!!Form::close()!!}

              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Content section End -->


@stop

@section('js')
{{--  --}}
@stop

