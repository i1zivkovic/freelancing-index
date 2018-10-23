@extends('layouts.frontend')

@section('title', 'Jobs')
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
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        {!! Form::open(['route' => ['frontend.myJobsFilter'], 'role' => 'form', 'autocomplete' => 'off', 'files' => false, 'method' => 'get', 'id' => 'search-form']) !!}
                        <div class="wrap-search-filter row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <input type="text" class="form-control" placeholder="Keyword: Title, Skill" name="q" value="{{!empty($request) ? $request->input('q') : ''}}">
                            </div>
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <input type="text" class="form-control" placeholder="Location: City, Country" name="location" value="{{!empty($request) ? $request->input('location') : ''}}">
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-12">
                                <button type="submit" class="btn btn-common float-right">Filter</button>
                            </div>
                        </div>
                        {!!Form::close()!!}
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                    @foreach($jobs as $job)
                    <div class="job-listings">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="job-company-logo">
                                        <img src="{{asset('img')}}/features/img1.png" alt="">
                                    </div>
                                    <div class="job-details">
                                        <a href="{{route('frontend.jobs.show',['id' => $job->slug])}}"><h3>{{$job->title}}</h3></a>
                                        <span class="company-neme">
                                            {{$job->user->username}}
                                        </span>
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
                                        <hr>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 text-center">

                                    <span class="btn-open">
                                        {{$job->offer}}€
                                        @if($job->is_per_hour)
                                        /h
                                        @else
                                        /project
                                        @endif
                                    </span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 text-center">
                                    <div class="location">
                                        <i class="lni-map-marker"></i> {{$job->job_location_city}},
                                        {{$job->job_location_country}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 text-center">
                                    <span class="btn-full-time">{{$job->job_comments_count}} <i class="lni-comments-alt"></i>&nbsp; &nbsp; {{$job->job_likes_count}} <i class="lni-heart"></i></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 text-center align-self-center">
                                        @if(Auth::user() && ($job->user_id == Auth::user()->id))
                                       <span><a href="{{route('frontend.jobs.edit',['id' => $job->id])}}">
                                               <i class="lni-pencil"></i>
                                           </a></span>
                                           &nbsp;
                                          <span><a href="#" class="delete-job" data-id="{{$job->id}}">
                                               <i class="lni-trash"></i>
                                           </a></span>
                                           @endif
                                </div>
                            </div>
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
