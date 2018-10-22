@extends('layouts.frontend')

@section('title', 'Update job')
@section('description', "")

@section('css')
{{-- --}}
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
                            <h3 class="job-title">Post a new Job</h3>
                            {!! Form::open(['method' => 'PUT', 'route' => ['frontend.jobs.update'], 'autocomplete' =>
                            'off',
                            'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'jobPostForm', 'class' =>
                            'form-ad']) !!}
                            @csrf
                            <div class="form-group">
                                <label class="control-label">Job Title</label>
                                <input type="text" class="form-control" placeholder="" name="title" required>
                            </div>
                            {{-- <div class="form-group">
                                <label class="control-label">Company</label>
                                <input type="text" class="form-control" placeholder="Write company name">
                            </div> --}}
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6">
                                    <label class="control-label">Job Country</label>
                                    <input type="text" class="form-control" name="job_location_country">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label class="control-label">Job City</label>
                                    <input type="text" class="form-control" placeholder="" name="job_location_city">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <div class="search-category-container">
                                    <label class="styled-select">
                                        <select class="dropdown-product selectpicker">
                                            <option>All Categories</option>
                                            <option>Finance</option>
                                            <option>IT & Engineering</option>
                                            <option>Education/Training</option>
                                            <option>Art/Design</option>
                                            <option>Sale/Markting</option>
                                            <option>Healthcare</option>
                                            <option>Science</option>
                                            <option>Food Services</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" placeholder="" name="description" value="" rows="7" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Price</label>
                                <input type="text" class="form-control" placeholder="" name="offer" required>
                            </div>
                            <div class="
                                        form-group">
                                <label class="control-label">Price type</label>
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
                            <div class="
                                        form-group">
                                <label class="control-label">Application E-mail / URL</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="validatedCustomFile">
                                <label class="custom-file-label form-control" for="validatedCustomFile">Choose
                                    file...</label>
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

        @stop
    </div>
</div>
@stop
