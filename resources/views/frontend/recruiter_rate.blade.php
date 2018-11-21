@extends('layouts.frontend')

@section('title', 'Rate User/s')
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
                    <div class="col-sm-12 col-lg-9 col-md-12 col-xs-12 text-center mb-5">
                        <h3>Rate User/s</h3>
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12">
                        <div class="post-job box">
                            {!! Form::open(['method' => 'POST', 'route' => ['frontend.storeRecruiter'],
                            'autocomplete' =>
                            'off', 'enctype' => 'multipart/form-data', 'id' => 'userRatingForm', 'class' =>
                            'form-ad']) !!}
                            @csrf

                            @if(session()->has('recruiter_rating_error'))
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{session()->get('recruiter_rating_error')}}
                            </div>
                            @endif

                            <div class="recruiter-rating-form mb-5">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <h6> <a href="{{route('frontend.user.show',['slug' => $recruiter->slug])}}">{{$recruiter->userProfile->first_name}}
                                                {{$recruiter->userProfile->last_name}}</a> </h6>
                                    </div>
                                </div>
                                <input type="hidden" name="rated_user_id" value="{{$recruiter->id}}">
                                <input type="hidden" name="job_id" value="{{$job_id}}">
                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select class="form-control {{$errors->has('rating') ? 'is-invalid' : ''}}" id="rating" name="rating">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    @if ($errors->has('rating'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea class="form-control {{$errors->has('comment') ? 'is-invalid' : ''}}" id="comment" rows="3" name="comment">{{old('comment')}}</textarea>
                                    @if ($errors->has('comment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <button type="submit" class="btn btn-common">Rate</button>
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
