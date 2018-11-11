@extends('layouts.frontend')

@section('title', 'Post')
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
                    <!-- Start Blog Posts -->
                    <div class="col-lg-8 col-md-12 col-xs-12">
                        <!-- Start Post -->
                        <div class="blog-post">

                            <!-- Post Content -->
                            <div class="post-content">
                                <h3 class="post-title">{{$post->title}}</h3>
                                <div class="meta">
                                    <span class="meta-part"><a href="{{route('frontend.user.show',['slug' => $post->user->slug])}}"><i
                                                class="lni-user"></i> By {{$post->user->username}}</a></span>
                                    <span class="meta-part"><i class="lni-calendar"></i>
                                        {{$post->updated_at->format('m/d/Y')}}</span>
                                </div>
                                <p>{{$post->description}}</p>
                                <br>
                                @if ($post->post_files)
                                <p id="file-info"> <a href="{{asset('uploads')}}/{{$post->user->username}}/posts/{{$post->id}}/{{$post->post_files->path}}"
                                        download>{{$post->post_files->path}}</a>
                                    @else
                                    <i>No files uploaded</i>
                                    @endif
                                @if(Auth::user() && ($post->user_id == Auth::user()->id))
                                <hr>
                                <a href="{{route('frontend.posts.edit',['id' => $post->id])}}">
                                    <i class="lni-pencil"></i>
                                </a>
                                &nbsp;
                                <a href="#" class="delete-post text-danger" data-id="{{$post->id}}">
                                    <i class="lni-trash"></i>
                                </a>
                                @endif
                            </div>
                            <!-- Post Content -->
                        </div>
                    </div>
                    <!-- End Post -->


                    {{-- Share and like --}}
                    <div class="col-lg-4 col-md-12 col-xs-12 mb-5">
                        <div class="sideber">
                            <div class="widghet">
                                <h3>Share This Post</h3>
                                <div class="share-post">
                                    <div class="form-group">
                                        <input type="text" name="share_link" class="form-control" value="http://localhost:8000/posts/{{$post->slug}}"
                                            style="color: #9a9a9a !important;">
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widghet">
                                <h3>Like This Post</h3>
                                <div class="">
                                    <div class="form-group">
                                        <a href="#!" onclick="actOnLikeUnlike(event);" data-id="{{$post->id}}" id="post-like-button">
                                            <i class="{{$post->post_likes->contains('user_id', Auth::id()) ? 'lni-heart-filled' : "lni-heart"}}"
                                                id="post-like-action"></i>
                                        </a>
                                        <span id="post-likes-count">{{$post->post_likes_count}}</span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End share and like --}}



                    <!-- Start Comment Area -->
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Comments ({{$post->post_comments->count()}})</a>
                        </ul>

                        <div id="comments">
                            <ol class="comments-list">
                                @forEach($post->post_comments as $comment)
                                <li id="row_{{$comment->id}}">
                                    <div class="media">
                                        <div class="info-body">
                                            <h4 class="name"><a href="{{route('frontend.user.show',['slug' => $comment->slug])}}">{{$comment->first_name}}
                                                    {{$comment->last_name}}</a></h4>
                                            <hr>
                                            <p id="post_comment_{{$comment->id}}">{{$comment->comment}}</p>
                                            <div id="comment_input_wrapper_{{$comment->id}}">
                                            </div>
                                            <span class="comment-date" id="post_comment_date_{{$comment->id}}">
                                                {{$comment->created_at->format('d/m/Y')}}
                                                @if($comment->updated_at != $comment->created_at)
                                                <small>- edited</small>
                                                @endif
                                            </span>

                                            @if(Auth::user() && ($comment->user_id == Auth::user()->id))
                                            <hr>
                                            <div id="comment_actions_{{$comment->id}}">
                                                <a href="#" class="edit-comment mr-1" data-id="{{$comment->id}}">
                                                    <i class="lni-pencil"></i>
                                                </a>
                                                <a href="#" class="delete-comment text-danger" data-id="{{$comment->id}}">
                                                    <i class="lni-trash"></i>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ol>
                            <!-- Start Respond Form -->
                            <div id="respond">
                                <h2 class="respond-title">Leave a comment</h2>
                                {!! Form::open(['method' => 'POST', 'route' =>
                                ['frontend.post-comments.store'], 'autocomplete' =>
                                'on','id' => 'commentForm', 'class' => 'form-ad']) !!}
                                @csrf
                                <input type="hidden" value="{{$post->id}}" name="post_id">
                                <input type="hidden" value="{{$post->slug}}" name="post_slug">
                                <input type="hidden" value="{{Auth::id()}}" name="user_id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                                name="comment" cols="45" rows="8" placeholder="Here goes your comment (1000 characters max.)"
                                                required>{{ old('comment') }}</textarea>
                                            @if ($errors->has('comment'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comment') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <button type="submit" id="submit" class="btn btn-common">Submit
                                            Comment</button>
                                    </div>
                                </div>
                                {!!Form::close()!!}
                            </div>
                            <!-- End Respond Form -->
                        </div>
                        <!-- End Comment Area -->
                    </div>
                    <!-- End Blog Posts -->
                </div>
            </div>
        </div>
        <!-- End Content -->



        @include('includes.frontend.loaderAndArrow')


        @section('js')
        <!-- Focus comment input if there is an error -->


        {!!Html::script(asset('js/custom/post-details.js'))!!}


        <!-- End Content -->
        @stop
    </div>
</div>
@stop
