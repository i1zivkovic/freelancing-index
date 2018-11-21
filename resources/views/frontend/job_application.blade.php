@extends('layouts.frontend')

@section('title', 'Apply for a job')
@section('description', "")

@section('css')
@stop

@section('content')
<div class="">
    <div class="space-100">


        <!-- Content section Start -->
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-xs-12 text-center">¸
                        <div class="job-info mb-5">
                            <p class="">You are applying for:</p>
                            <a class="" href="http://localhost:8000/jobs/{{$job->slug}}">http://localhost:8000/jobs/{{$job->slug}}</a>
                        </div>
                        @if(session()->has('success'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{session()->get('success')}}
                        </div>
                        @elseif (session()->has('alreadyApplied'))
                        <div class="alert alert-danger mb-3" role="alert">
                            {{session()->get('alreadyApplied')}}
                        </div>
                        @endif
                        <div class="post-job box">
                            {!! Form::open(['method' => 'POST', 'route' => ['frontend.job-applications.store'],
                            'autocomplete' =>
                            'off',
                            'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'jobApplicationForm', 'class'
                            =>
                            'form-ad']) !!}
                            @csrf
                            <input type="hidden" name="job_id" value="{{$job->id}}">
                            <div class="form-group">
                                <label class="control-label">*Comment</label>
                                <textarea class="form-control {{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                    placeholder="" name="comment" value="" rows="7" required>{{old('comment')}}</textarea>
                                @if ($errors->has('comment'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-common">Apply</button>
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
