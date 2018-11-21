@extends('layouts.frontend')

@section('title', 'Find a job')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')
<div class="">
    <div class="space-100">

        <section class="job-browse section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center mb-5">
                        <h3>Find a job</h3>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 mb-2">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            <i class="lni-funnel"></i> Filter jobs
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in show">
                                    <div class="panel-body">

                                        {!! Form::open(['route' => ['frontend.jobsFilter'], 'role' => 'form',
                                        'autocomplete' => 'off',
                                        'files' => false, 'method' => 'get', 'id' => 'search-form']) !!}
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 mb-3">
                                                <input type="text" class="form-control" placeholder="User: Username, First/Last Name"
                                                    name="user" value="{{!empty($request) ? $request->input('user') : null}}">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-xs-12 mb-3">
                                                <input type="text" class="form-control" placeholder="Keyword: Title, Skill"
                                                    name="q" value="{{!empty($request) ? $request->input('q') : null}}">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-xs-12 mb-3">
                                                <input type="text" class="form-control" placeholder="Location: City, Country"
                                                    name="location" value="{{!empty($request) ? $request->input('location') : null}}">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-xs-12 mb-3">
                                                <input type="text" class="form-control" placeholder="Category: Graphic Design, Programming"
                                                    name="category" value="{{!empty($request) ? $request->input('category') : null}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12">
                                                <button type="submit" class="btn btn-common btn-block">Filter</button>
                                            </div>
                                        </div>
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-xs-12">

                        @if($jobs->count() == 0)
                        <p class=""><b>0</b> results</p>
                        <hr>
                        @else
                        <p>About <b>{{$jobs->total()}}</b>
                            {{$jobs->total() % 10 == 1 && $jobs->total() % 11 != 0 ? 'result' :
                            'results'}}
                        </p>
                        <hr>
                        @endif

                        @foreach($jobs as $job)
                        <a class="job-listings" href="{{route('frontend.jobs.show',['id' => $job->slug])}}">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="job-company-logo">
                                        <img class="img-fluid" src="{{asset('uploads')}}/{{$job->user->username}}/{{$job->user->userProfile->image_url}}"
                                            alt="PIC">
                                    </div>
                                    <div class="job-details">
                                        <h3>{{$job->title}}</h3>
                                        <span class="company-neme">
                                            {{$job->user->username}}
                                        </span>
                                    </div>

                                    <hr>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12 text-left">
                                    <p>
                                        {{ str_limit($job->description, $limit = 300, $end = '...') }}
                                    </p>
                                    @if ($job->job_skills->count() > 0)
                                    <br>
                                    <div class="tag-list">
                                        @foreach($job->job_skills as $jobSkill)
                                        <span>{{$jobSkill->name}}</span>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if ($job->job_business_categories->count() > 0)
                                    <br>
                                    <div class="category-list">
                                        @foreach($job->job_business_categories as $jobCategory)
                                        @if($loop->last)
                                        <span>{{$jobCategory->name}}</span>
                                        @else
                                        <span>{{$jobCategory->name}} - </span>
                                        @endif
                                        @endforeach
                                    </div>
                                    @endif
                                    <hr>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 text-center">

                                    <span class="btn-open">
                                        {{$job->offer}}$
                                        @if($job->is_per_hour)
                                        /h
                                        @else
                                        /project
                                        @endif
                                    </span>
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12 text-center">
                                    <div class="location">
                                        <i class="lni-map-marker"></i> {{$job->job_location_city}},
                                        {{$job->job_location_country}}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12 text-center">
                                    <span class="btn-full-time">{{$job->job_comments_count}} <i class="lni-comments-alt"></i>
                                        {{$job->job_likes_count}} <i class="lni-heart"></i></span>
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12 text-center">
                                    <span class="btn-full-time">{{$job->job_applications_count}} <i class="lni-pencil-alt"></i></span>
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12 text-center">
                                    @if ($job->job_status->id == 3)
                                    <span class="btn-full-time text-danger"> {{$job->job_status->name}} </span>
                                    @elseif ($job->job_status->id == 1)
                                    <span class="btn-full-time text-primary"> {{$job->job_status->name}} </span>
                                    @elseif ($job->job_status->id == 4)
                                    <span class="btn-full-time text-info"> {{$job->job_status->name}} </span>
                                    @else
                                    <span class="btn-full-time"> {{$job->job_status->name}} </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach



                        <!-- Start Pagination -->
                        @if(empty($request))
                        {!! $jobs -> links()!!}
                        @else
                        {{ $jobs->appends($request->all())->links() }}
                        @endif
                        <!-- End Pagination -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Job Browse Section End -->




        @include('includes.frontend.loaderAndArrow')
        @section('js')
        <script type="text/javascript">
            $('#search-form').submit(function () {
                $(this)
                    .find('input[name]')
                    .filter(function () {
                        return !this.value;
                    })
                    .prop('name', '');
            });

        </script>

        @stop
    </div>
</div>
@stop
