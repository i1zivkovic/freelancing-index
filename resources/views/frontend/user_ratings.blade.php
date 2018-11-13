@extends('layouts.frontend')

@section('title', 'My Ratings')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')
<div class="">
    <div class="space-100">

        <!-- Start Content -->
        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 text-center mb-5">
                        <h3>My Ratings</h3>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">

                        @if($ratings->count() == 0)
                        <p class=""><b>0</b> results</p>
                        <hr>
                        @else
                        <p>About <b>{{$ratings->count()}}</b>
                            {{$ratings->count() % 10 == 1 && $ratings->count() % 11 != 0 ? 'result' :
                            'results'}}
                        </p>
                        <hr>
                        @endif

                        @foreach($ratings as $rating)
                            <div class="manager-resumes-item">
                                <div class="manager-content">
                                    @if($rating->recruiter)
                                    <a href="{{route('frontend.user.show',['slug' => $rating->recruiter->slug])}}"><img class="resume-thumb img-fluid" alt="PIC" src="{{asset('uploads')}}/{{$rating->recruiter->username}}/{{$rating->recruiter->userProfile->image_url}}"></a>
                                    @else

                                    @endif
                                    <div class="manager-info">
                                        <div class="manager-name">
                                                @if($rating->recruiter)
                                            <h4><a href="{{route('frontend.user.show',['slug' => $rating->recruiter->slug])}}">{{$rating->recruiter->userProfile->first_name}}
                                                    {{$rating->recruiter->userProfile->last_name}}</a></h4>
                                            <h5><i class="lni-user"></i> {{$rating->recruiter->username}}</h5>
                                            @else

                                            <h4><a href="#!">Deleted user</a></h4>
                                             @endif
                                        </div>
                                        <div class="manager-meta">
                                            <span class="location">{{$rating->rating}} <i class="lni-star-filled"></i></span>
                                            <span class="rate">{{\Carbon\Carbon::parse($rating->created_at)->format('d/m/Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-body">
                                    <div class="content">
                                        <p>"{{$rating->comment}}"</p>
                                    </div>
                                    <div class="resume-skills">
                                        @if($rating->job)
                                        Job: <a href="{{route('frontend.jobs.show',['id' => $rating->job->slug])}}">{{$rating->job->title}}</a>
                                        @else
                                        Job: <i>Deleted job</i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->




        @include('includes.frontend.loaderAndArrow')


        @section('js')

        @stop
    </div>
</div>
@stop
