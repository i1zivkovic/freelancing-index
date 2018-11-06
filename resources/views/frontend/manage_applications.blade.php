@extends('layouts.frontend')

@section('title', 'Manage Applications')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')
<div class="">
    <div class="space-100">

        <section class="manage-applications section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center mb-5">
                        <h3>Manage Applications</h3>
                    </div>
                    <div class="col-lg-4 col-md-12 col-xs-12 mb-2">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            <i class="lni-funnel"></i> Jobs
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in show">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 mb-3">
                                                @foreach($jobs as $job)
                                                <a href="{{route('frontend.getManageApplicationsSlug',['id' => $job->slug])}}">
                                                    <p class=" mb-3 {{!empty($selected_job) && $job->id == $selected_job->id ? 'job-app-title-active' : ''}}">
                                                        {{$job->title}}
                                                    </p>
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-xs-12">
                        @if($job_applications->count() == 0)
                        <p class="text-center"><b>Currently there are no applicants for your jobs!</b></p>
                        @else
                        <p>About <b>{{$job_applications->total()}}</b>
                            {{$job_applications->total() % 10 == 1 && $job_applications->total() % 11 != 0 ? 'result' :
                            'results'}}
                        </p>
                        <hr>
                        @endif
                        @foreach($job_applications as $job_application)



                        <div class="manager-resumes-item">
                            <div class="manager-content">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <a href="#!"><img class="resume-thumb" src="{{asset('img')}}/features/img1.png"
                                                alt=""></a>
                                        <div class="manager-info">
                                            <div class="manager-name">
                                                <h4> <a href="{{route('frontend.user.show',['id' => $job_application->user->slug])}}">
                                                        {{$job_application->user->username}}
                                                    </a></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 text-right">
                                        <p>{{\Carbon\Carbon::createFromTimeStamp(strtotime($job_application->created_at))->diffForHumans()}}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="item-body">
                                <div class="content">
                                Job: <a href="http://localhost:8000/jobs/{{$job_application->job->slug}}">{{$job_application->job->slug}}</a>
                                    <br>
                                    <br>
                                    <p>{{$job_application->comment}}</p>
                                </div>
                                <div class="resume-skills">
                                    <div class="row"></div>
                                    @if($job_application->job_application_state->id == 1)
                                    <a href="#!" class="accept-application" onclick="actOnJobApplicationAction({{$job_application->id}}, 2, {{$job_application->job_id}})">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#!" class="reject-application" onclick="actOnJobApplicationAction({{$job_application->id}}, 3, {{$job_application->job_id}})">
                                        <i class="fas fa-times text-danger"></i>
                                    </a>
                                    @else
                                <p class="{{$job_application->job_application_state->state == 'Accepted' ? 'text-success' : 'text-danger'}}">{{$job_application->job_application_state->state}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach



                        <!-- Start Pagination -->
                        {!! $job_applications -> links()!!}
                        <!-- End Pagination -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Job Browse Section End -->




        @include('includes.frontend.loaderAndArrow')
        @section('js')
        {!!Html::script(asset('js/custom/job-details.js'))!!}
        @stop
    </div>
</div>
@stop
