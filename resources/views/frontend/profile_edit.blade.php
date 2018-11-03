@extends('layouts.frontend')

@section('title', 'Edit Profile')
@section('description', "")

@section('css')
{{-- --}}
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
                        <a class="nav-link" id="applications-tab" data-toggle="tab" href="#applications" role="tab"
                            aria-controls="applications" aria-selected="false">Account Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab"
                            aria-controls="comments" aria-selected="true">Profile Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab"
                            aria-controls="comments" aria-selected="true">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab"
                            aria-controls="comments" aria-selected="true">Education</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="experiences-tab" data-toggle="tab" href="#experiences" role="tab"
                            aria-controls="experiences" aria-selected="true">Work Experience</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane" id="comments" role="tabpanel" aria-labelledby="comments-tab">

                    </div>
                    <div class="tab-pane" id="applications" role="tabpanel" aria-labelledby="applications-tab">

                    </div>
                    <div class="tab-pane" id="applications" role="tabpanel" aria-labelledby="applications-tab">

                    </div>
                    <div class="tab-pane" id="applications" role="tabpanel" aria-labelledby="applications-tab">

                    </div>
                    <div class="tab-pane active" id="experiences" role="tabpanel" aria-labelledby="experiences-tab">
                        {!! Form::open(['method' => 'POST', 'route' => ['frontend.profileExperience'], 'autocomplete'
                        =>
                        'off', 'files' => false, 'enctype' => 'multipart/form-data', 'id' => 'jobPostForm', 'class' =>
                        'form-ad','mb-3']) !!}
                        @csrf
                        <div class="experience-entry">
                            <div class="row mb-3">
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Company Name</label>
                                    <input type="text" class="form-control {{$errors->has('company_name.0') ? 'is-invalid' : ''}}" placeholder="" name="company_name[]"
                                            required value="">
                                        @if ($errors->has('company_name.0'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company_name.0') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Job Title</label>
                                        <input type="text" class="form-control" placeholder="" name="job_title[]"
                                            required value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="control-label">Job Description</label>
                                        <textarea name="job_description[]" id="" cols="30" rows="7" class="form-control"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <input type="text" class="form-control" placeholder="" name="job_location_country[]"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" class="form-control" placeholder="" name="job_location_city[]"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="control-label">Is Remote</label>
                                        <div class="search-category-container post-job">
                                            <label class="styled-select">
                                                <select class="dropdown-product selectpicker" name="is_remote[]">
                                                    <option value="1" selected>Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <input type="date" class="form-control" placeholder="" name="start_date[]"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input type="date" class="form-control" placeholder="" name="end_date[]" value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="add-post-btn">
                                        <a href="#!" class="btn-delete remove-experience">Remove</a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            {{-- row mb5 --}}
                        </div>
                        {{-- experiences --}}
                        <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 text-center mb-5">
                            <div class="add-post-btn">
                                <a href="#!" class="btn-added" id="add-experience">Add New Experience</a>
                            </div>
                        </div>

                        <div class="col-xs-12 text-center">
                            <button class="btn btn-common" type="submit" id="submit-experience">Update</button>
                        </div>

                        {{-- {{dd(old('company_name'))}} --}}
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>

</section>
<!-- Content section End -->


@stop

@section('js')
{{-- --}}


<script type="text/javascript">
    var max_fields = 10; //maximum experiences
    var wrapper = $(".experience-entry"); // Fields wrapper
    var add_button = $("#add-experience"); // Add button

    var x = 1; //initlal text box count
    $(add_button).click(function (e) { //on add input button click

        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                `   <div class="row mb-3">
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Company Name</label>
                                        <input type="text" class="form-control" placeholder="" name="company_name[]"
                                            required value="">
                                            @if ($errors->has('company_name.${x}'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company_name.${x}') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Job Title</label>
                                        <input type="text" class="form-control" placeholder="" name="job_title[]"
                                            required value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label class="control-label">Job Description</label>
                                        <textarea name="job_description[]" id="" cols="30" rows="7" class="form-control"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <input type="text" class="form-control" placeholder="" name="job_location_country[]"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" class="form-control" placeholder="" name="job_location_city[]"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="control-label">Is Remote</label>
                                        <div class="search-category-container post-job">
                                            <label class="styled-select">
                                                <select class="dropdown-product selectpicker" name="is_remote[]">
                                                    <option value="1" selected>Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="control-label">Start Date</label>
                                        <input type="date" class="form-control" placeholder="" name="start_date[]"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <input type="date" class="form-control" placeholder="" name="end_date[]" value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 ">
                                    <div class="add-post-btn">
                                      <a href="#!" class="btn-delete remove-experience">Remove</a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                           `
            ); //add input box
        }
    });

    $(wrapper).on("click", ".remove-experience", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent().parent().parent('div').remove();
        x--;
    })

</script>
@stop
