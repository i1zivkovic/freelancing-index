@extends('layouts.frontend')

@section('title', 'User Applications')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')

<!-- Start Content -->
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center mb-5">
                <h3>My Job Applications</h3>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">

                @if($job_applications->count() == 0)
                <p class=""><b>0</b> results</p>
                        <hr>
                @else
                <p>About <b>{{$job_applications->total()}}</b>
                    {{$job_applications->total() % 10 == 1 && $job_applications->total() % 11 != 0 ? 'result' :
                    'results'}}
                </p>
                <hr>

                <div class="job-alerts-item">
                    @foreach($job_applications as $job_application)
                    <div class="applications-content">
                        <div class="row">
                            <div class="col-md-4">
                                <h3><a href="{{route('frontend.jobs.show',['slug' => $job_application->job->slug])}}">{{$job_application->job->title}}</a></h3>
                                <span><a href="{{route('frontend.user.show',['slug' => $job_application->job->user->slug])}}"><i
                                            class="fas fa-user-tie"></i> {{$job_application->job->user->username}}</a></span>
                            </div>

                            <div class="col-md-4 text-center">
                                <p><i class="far fa-calendar-alt"></i>
                                    {{\Carbon\Carbon::parse($job_application->updated_at)->format('d/m/Y')}}</p>
                            </div>
                            <div class="col-md-4 text-right">
                                @if ($job_application->job_application_state->state == 'Rejected')
                                <p class="text-danger">{{$job_application->job_application_state->state}} <i class="fas fa-times"></i></p>
                                @elseif ($job_application->job_application_state->state == 'Accepted')
                                <p class="text-success">{{$job_application->job_application_state->state}} <i class="fas fa-check"></i></p>
                                @else
                                <p>{{$job_application->job_application_state->state}} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Start Pagination -->
                    {!! $job_applications -> links()!!}
                        <!-- End Pagination -->
                @endif
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
