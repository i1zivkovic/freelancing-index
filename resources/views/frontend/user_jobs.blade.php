@extends('layouts.frontend')

@section('title', 'My Jobs')
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
                    @if($jobs->count() <= 0) <div class="col-lg-12 col-md-12 col-xs-12 mb-2 text-center">
                        <h5>You have no job ads posted so far.</h5>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 mb-2 text-center">
                    <a class="btn btn-common" href="{{route('frontend.jobs.create')}}">Post a job</a>
                </div>
                @else
                <div class="col-sm-12 text-center mb-5">
                    <h3>My Job Ads</h3>
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

                                    {!! Form::open(['route' => ['frontend.myJobsFilter'], 'role' => 'form',
                                    'autocomplete' => 'off',
                                    'files' => false, 'method' => 'get', 'id' => 'search-form']) !!}
                                    @csrf
                                    <div class="row">
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

                    @if($jobs->count() > 0)
                    <p>About <b>{{$jobs->total()}}</b>
                        {{$jobs->total() % 10 == 1 && $jobs->total() % 11 != 0 ? 'result' :
                        'results'}}
                    </p>
                    <hr>
                    @endif

                    @foreach($jobs as $job)
                    <div class="job-listings">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                {{-- <div class="job-company-logo">
                                    <img class="img-fluid" src="{{asset('uploads')}}/{{$job->user->username}}/{{$job->user->userProfile->image_url}}"
                                        alt="PIC">
                                </div> --}}
                                <div class="job-details">
                                    <a href="{{route('frontend.jobs.show',['id' => $job->slug])}}">
                                        <h3>{{$job->title}}</h3>
                                    </a>
                                </div>

                                <hr>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12 text-left">
                                <p>
                                    {{$job->description}}
                                </p>
                                <br>
                                <div class="tag-list">
                                    @foreach($job->job_skills as $jobSkill)
                                    <span>{{$jobSkill->name}}</span>
                                    @endforeach
                                </div>
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
                                <hr>
                            </div>
                            <div class="col-lg-3 col-md-4 col-xs-12 text-center">

                                <span class="btn-open">
                                    {{$job->offer}}€
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
                                <span class="btn-full-time">{{$job->job_comments_count}} <i class="lni-comments-alt"></i>&nbsp;
                                    &nbsp; {{$job->job_likes_count}} <i class="lni-heart"></i></span>
                            </div>
                            <div class="col-lg-1 col-md-4 col-xs-12 text-center">
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
                                    <span class="btn-full-time text-success"> {{$job->job_status->name}} </span>
                                    @endif
                            </div>
                            <div class="col-lg-2 col-md-4 col-xs-12 text-center">
                                @if(Auth::user() && ($job->user_id == Auth::user()->id) && ($job->job_status_id != 2))
                                <span class="btn-full-time"><a href="{{route('frontend.jobs.edit',['id' => $job->id])}}">
                                        <i class="lni-pencil"></i>
                                    </a></span>
                                &nbsp;
                                <span class="btn-full-time"><a href="#" class="delete-job text-danger" data-id="{{$job->id}}">
                                        <i class="lni-trash"></i>
                                    </a></span>
                                @endif
                            </div>
                        </div>
                        @if(session()->has('edit_error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            {{session()->get('edit_error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>
                    @endforeach



                    <!-- Start Pagination -->
                    @if(empty($request))
                    {!! $jobs -> links()!!}
                    @else
                    {{ $jobs->appends($request->all())->links() }}
                    @endif
                    <!-- End Pagination -->
                </div>
                @endif
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

    {!!Html::script(asset('js/custom/user-jobs.js'))!!}

    @stop
</div>
</div>
@stop
