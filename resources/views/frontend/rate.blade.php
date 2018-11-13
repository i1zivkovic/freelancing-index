@extends('layouts.frontend')

@section('title', 'Rate Freelancers')
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
                        <h3>Rate User</h3>
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12">
                        <div class="post-job box">
                            {!! Form::open(['method' => 'POST', 'route' => ['frontend.user-ratings.store'],
                            'autocomplete' =>
                            'off', 'enctype' => 'multipart/form-data', 'id' => 'userRatingForm', 'class' =>
                            'form-ad']) !!}
                            @csrf
                            <input type="hidden" name="job_id" value="{{$job_id}}">
                            @if(empty(old('comment')))
                            @foreach($freelancers as $freelancer)
                            <div class="user-rating-form mb-5">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <h6> <a href="{{route('frontend.user.show',['slug' => $freelancer->slug])}}">{{$freelancer->userProfile->first_name}}
                                                {{$freelancer->userProfile->last_name}}</a> </h6>
                                    </div>
                                </div>
                                <input type="hidden" name="freelancer_id[]" value="{{$freelancer->id}}">
                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select class="form-control" id="rating" name="rating[]">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea class="form-control" id="comment" rows="3" name="comment[]"></textarea>
                                </div>
                            </div>
                            @endforeach

                            @else
                            @foreach(old('comment') as $key => $comment)
                            <div class="user-rating-form mb-5">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <h6> <a href="{{route('frontend.user.show',['slug' => $freelancers[$key]->slug])}}">{{$freelancers[$key]->userProfile->first_name}}
                                                {{$freelancers[$key]->userProfile->last_name}}</a> </h6>
                                    </div>
                                </div>
                                <input type="hidden" name="freelancer_id[]" value="{{$freelancers[$key]->id}}">
                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select class="form-control {{$errors->has('rating.'.$key) ? 'is-invalid' : ''}}"
                                        id="rating" name="rating[]">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    @if ($errors->has('rating.'.$key))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rating.'.$key) }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea class="form-control {{$errors->has('comment.'.$key) ? 'is-invalid' : ''}}"
                                        id="comment" rows="3" name="comment[]"></textarea>
                                    @if ($errors->has('comment.'.$key))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment.'.$key) }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @endif


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
