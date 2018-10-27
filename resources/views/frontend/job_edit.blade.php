@extends('layouts.frontend')

@section('title', 'Update job')
@section('description', "")

@section('css')
{{-- --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<div class="">
    <div class="space-100">


        <!-- Content section Start -->
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-md-12 col-xs-12">
                        <div class="post-job box">
                            <h3 class="job-title">Edit you job</h3>
                            {!! Form::open(['method' => 'PUT', 'route' => ['frontend.jobs.update', $job->id],
                            'autocomplete' =>
                            'off',
                            'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'jobPostForm', 'class' =>
                            'form-ad']) !!}
                            @csrf
                            <div class="form-group">
                                <label class="control-label">Job Title</label>
                                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="" name="title" required value="{{$job->title}}">
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
                                        <input type="text" class="form-control {{ $errors->has('job_location_country') ? ' is-invalid' : '' }}" name="job_location_country" value="{{$job->job_location_country}}">
                                        @if ($errors->has('job_location_country'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('job_location_country') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="control-label">Job City</label>
                                        <input type="text" class="form-control {{ $errors->has('job_location_city') ? ' is-invalid' : '' }}" placeholder="" name="job_location_city"
                                            value="{{$job->job_location_city}}">
                                            @if ($errors->has('job_location_city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('job_location_city') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <div class="search-category-container">
                                    <label class="styled-select">
                                        {!! Form::select('business_category_id[]', $businessCategories,
                                        $selectedCategories, ['class' => ' dropdown-product selectpicker
                                        js-example-basic-multiple', 'multiple' =>
                                        true]) !!}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Required Skills</label>
                                <div class="search-category-container">
                                    <label class="styled-select">
                                        {!! Form::select('skill_list[]', $skills,
                                        $selectedSkills, ['class' => ' dropdown-product selectpicker
                                        js-example-basic-multiple', 'multiple' =>
                                        true, 'id'=>'skill_list']) !!}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="" name="description" value="" rows="7"
                                    required>{{$job->description}}</textarea>
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Offer</label>
                                <input type="text" class="form-control {{ $errors->has('offer') ? ' is-invalid' : '' }}" placeholder="" name="offer" required value="{{$job->offer}}">
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
                                        {!! Form::select('is_per_hour', [1 => 'Per Hour', 0 => 'Per Project'],
                                        $job->is_per_hour, ['class' => 'dropdown-product selectpicker']) !!}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label">Is remote</label>
                                <div class="search-category-container">
                                    <label class="styled-select">
                                        {!! Form::select('is_remote', [1 => 'Yes', 0 => 'No'], $job->is_remote,
                                        ['class' => 'dropdown-product selectpicker']) !!}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Upload File (will create new or overwrite existing)</label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                   {{--  <span class="help-block"> <i>Uploading a file will create new file or overwrite if
                                            one
                                            already exists.</i></span> --}}
                                    <label class="custom-file-label form-control" for="file" id="file-label">
                                        Choose file...
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="control-label">Uploaded File</label>
                            @if ($job->job_files)
                            <div class="form-group">
                                <p id="file-info"> <a href="{{asset('uploads')}}/{{Auth::user()->username}}/{{$job->job_files->path}}"
                                        download>{{$job->job_files->path}}</a> <a href="#!" class="text-danger" id="delete-file"
                                        data-id="{{$job->job_files->id}}"><i class="lni-trash"></i></a></p>
                            </div>
                            @endif
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-common">Update your job</button>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section End -->



        @include('includes.frontend.loaderAndArrow')
        @section('js')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        {!!Html::script(asset('js/custom/job-edit.js'))!!}

        @stop
    </div>
</div>
@stop
