@extends('layouts.frontend')

@section('title', 'Post A Job')
@section('description', "")

@section('css')
{{-- --}}
{!!Html::style(asset('css/select2.min.css'))!!}
@stop

@section('content')
<div class="">
    <div class="space-100">


        <!-- Content section Start -->
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                        <div class="col-sm-12 col-lg-9 col-md-12 col-xs-12 text-center mb-5">
                                <h3>Post a new job ad</h3>
                            </div>
                    <div class="col-lg-9 col-md-12 col-xs-12">
                        <div class="post-job box">
                            {!! Form::open(['method' => 'POST', 'route' => ['frontend.jobs.store'], 'autocomplete' =>
                            'off',
                            'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'jobPostForm', 'class' =>
                            'form-ad']) !!}
                            @csrf
                            <div class="form-group">
                                <label class="control-label">Job Title</label>
                            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="" name="title" required value="{{old('title')}}">
                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                            {{-- <div class="form-group">
                                <label class="control-label">Company</label>
                                <input type="text" class="form-control" placeholder="Write company name">
                            </div> --}}
                            <div class="form-group">
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6">
                                    <label class="control-label">Job Country</label>
                                    <input type="text" class="form-control {{ $errors->has('job_location_country') ? ' is-invalid' : '' }}" name="job_location_country" value="{{old('job_location_country')}}">
                                    @if ($errors->has('job_location_country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('job_location_country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label class="control-label">Job City</label>
                                    <input type="text" class="form-control {{ $errors->has('job_location_city') ? ' is-invalid' : '' }}" placeholder="" name="job_location_city"  value="{{old('job_location_city')}}">
                                    @if ($errors->has('job_location_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('job_location_city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="control-label">Categories</label>
                                <div class="search-category-container">
                                    <label class="styled-select">
                                        {!! Form::select('business_category_id[]', $businessCategories,
                                        old('business_category_id'), ['class' => ' dropdown-product selectpicker
                                        js-example-basic-multiple', 'multiple' =>
                                        true]) !!}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Required skills</label>
                                <div class="search-category-container">

                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker js-data-example-ajax" id="skill_list"
                                            multiple="multiple" name="skill_list[]"></select>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="" name="description" value="" rows="7"
                                    required>{{old('description')}}</textarea>
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Offer ($)</label>
                                <input type="text" class="form-control {{ $errors->has('offer') ? ' is-invalid' : '' }}" placeholder="" name="offer" required value="{{old('offer')}}">
                                @if ($errors->has('offer'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('offer') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="
                                        form-group">
                                <label class="control-label">Offer type</label>
                                <div class="search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="is_per_hour">
                                            <option value="1" selected>Per hour</option>
                                            <option value="0">Per project</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Is remote</label>
                                <div class="search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker" name="is_remote">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="control-label">Upload File</label>
                                    <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="file" name="file">
                                            <label class="custom-file-label form-control" for="file" id="file-label">Choose
                                                file...</label>
                                        </div>
                            </div>
                            <button type="submit" class="btn btn-common">Submit your job</button>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section End -->



        @include('includes.frontend.loaderAndArrow')
        @section('js')

        {!!Html::script(asset('js/select2.min.js'))!!}

        {!!Html::script(asset('js/custom/job-create.js'))!!}
        @stop
    </div>
</div>
@stop
