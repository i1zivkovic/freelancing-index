@extends('layouts.frontend')

@section('title', 'My Followers')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')

<div class="">
    <div class="space-100">

        <!-- Start Content -->
        <div id="content" class="community-users">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center mb-5">
                        <h3>My Followers</h3>
                    </div>

                    <div class="col-lg-12 col-md-12 col-xs-12 mb-2">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            <i class="lni-funnel"></i> Filter followers
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in show">
                                    <div class="panel-body">

                                        {!! Form::open(['route' => ['frontend.followersFilter'], 'role' => 'form',
                                        'autocomplete' => 'off',
                                        'files' => false, 'method' => 'get', 'id' => 'search-form']) !!}
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-xs-12 mb-3">
                                                <input type="text" class="form-control" placeholder="Keyword: Username, First/Last name"
                                                    name="q" value="{{!empty($request) ? $request->input('q') : null}}">
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-xs-12 mb-3">
                                                <input type="text" class="form-control" placeholder="Location: Country, City"
                                                    name="location" value="{{!empty($request) ? $request->input('location') : null}}">
                                            </div>
                                            <div class="col-lg-4 col-md-3 col-xs-12">
                                                <button type="submit" class="btn btn-common btn-block">Filter</button>
                                            </div>
                                        </div>

                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-sm-12">
                        @if($followers->count() == 0)
                        <p class=""><b>0</b> results</p>
                        <hr>
                        @else
                        <p>About <b>{{$followers->total()}}</b>
                            {{$followers->total() % 10 == 1 && $followers->total() % 11 != 0 ? 'result' :
                            'results'}}
                        </p>
                        <hr>
                        @endif
                    </div>


                    @foreach($followers as $follower)
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="manager-resumes-item">
                            <div class="manager-content">
                                <a href="{{route('frontend.user.show',['slug' => $follower->slug])}}"><img class="resume-thumb img-fluid" src="{{asset('uploads')}}/{{$follower->username}}/{{$follower->userProfile->image_url}}"
                                    alt="PIC"></a>
                                <div class="manager-info">
                                    <div class="manager-name">
                                        <h4><a href="{{route('frontend.user.show',['slug' => $follower->slug])}}">{{$follower->userProfile->first_name}}
                                                {{$follower->userProfile->last_name}}</a></h4>
                                        <h5><i class="lni-user"></i> {{$follower->username}}</h5>
                                    </div>
                                    <div class="manager-meta">
                                        <span class="location"><i class="lni-map-marker"></i>{{$follower->userLocation ?
                                            $follower->userLocation->city .', '. $follower->userLocation->country: 'Unkown
                                            location'}}</span>
                                        <span class="rate"><i class="ti-time"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item-body">
                                <div class="content">
                                    <p>{{ str_limit($follower->userProfile->about_me, $limit = 300, $end = '...') }}</p>
                                    <br>
                                    <div class="tag-list">
                                        @foreach($follower->userSkills as $skill)
                                        <span>{{$skill->name}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @if($follower->id != Auth::id())
                                <div class="resume-skills">
                                    <div class="float-right">
                                        <a href="#!" class="btn {{$follower->followers->contains('follower_id', Auth::id()) ?  'btn-danger' : 'btn-common'}} btn-xs follow-unfollow"
                                            data-id="{{$follower->id}}" onclick="actOnFollowUnfollow(this)"><i class="fas {{$follower->followers->contains('follower_id', Auth::id()) ?  'fa-user-minus' : 'fa-user-plus'}} follow-unfollow-icon"></i></i></a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach



                    <!-- Start Pagination -->
                    @if(empty($request))
                    {!! $followers -> links()!!}
                    @else
                    {{ $followers->appends($request->all())->links() }}
                    @endif
                    <!-- End Pagination -->

                </div>
            </div>
        </div>
        <!-- End Content -->



        @include('includes.frontend.loaderAndArrow')

        @section('js')
        {{-- --}}


        {!!Html::script(asset('js/custom/community.js'))!!}
        @stop
    </div>
</div>
@stop
