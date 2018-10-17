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
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <!-- Start Post -->
                        <div class="blog-post">
                            <!-- Post thumb -->
                            <div class="post-thumb">
                                <img class="img-fluid" src="{{asset('img')}}/blog/blog1.jpg" alt="">
                                <div class="hover-wrap">
                                </div>
                            </div>
                            <!-- End Post post-thumb -->

                            <!-- Post Content -->
                            <div class="post-content">
                                <h3 class="post-title"><a href="">{{$post->title}}</a></h3>
                                <div class="meta">
                                    <span class="meta-part"><a href="{{route('frontend.user.show',['slug' => $post->user->slug])}}"><i
                                                class="lni-user"></i> By {{$post->user->username}}</a></span>
                                    <span class="meta-part"><i class="lni-calendar"></i>
                                            {{$post->created_at->format('m/d/Y H:i:s')}}</span>
                                    <span class="meta-part"><i class="lni-comments-alt"></i>
                                            {{$post->postComments->count()}} Comments</span>
                                    <span class="meta-part"><i class="lni-heart-filled"></i>
                                            {{$post->post_likes_count}} Likes</span>
                                </div>
                                <p>{{$post->description}}</p>
                                {{-- <div class="share-social">
                                    <span>Share This Job:</span>
                                    <div class="social-link">
                                        <a class="MagNews" target="_blank" data-original-title="twitter" href="#"
                                            data-toggle="tooltip" data-placement="top"><i class="lni-twitter-filled"></i></a>
                                        <a class="facebook" target="_blank" data-original-title="facebook" href="#"
                                            data-toggle="tooltip" data-placement="top"><i class="lni-facebook-filled"></i></a>
                                        <a class="google" target="_blank" data-original-title="google-plus" href="#"
                                            data-toggle="tooltip" data-placement="top"><i class="lni-google-plus"></i></a>
                                        <a class="linkedin" target="_blank" data-original-title="linkedin" href="#"
                                            data-toggle="tooltip" data-placement="top"><i class="lni-linkedin-fill"></i></a>
                                    </div>
                                </div> --}}
                            </div>
                            <!-- Post Content -->
                        </div>
                        <!-- End Post -->

                        <!-- Start Comment Area -->
                        <div id="comments">
                            <h3>There are {{$post->postComments->count()}} comments on this post</h3>
                            <ol class="comments-list">
                                @forEach($post->postComments as $comment)
                                <li id="row_{{$comment->id}}">
                                    <div class="media">
                                        <div class="thumb-left">
                                            <a href="#">
                                                <img src="{{asset('img')}}/blog/user1.png" alt="">
                                            </a>
                                        </div>
                                        <div class="info-body">
                                            <h4 class="name"><a href="{{route('frontend.user.show',['slug' => $comment->slug])}}">{{$comment->first_name}}
                                                    {{$comment->last_name}}</a></h4>
                                            <hr>
                                            <p>{{$comment->comment}}</p>
                                            <span class="comment-date">{{$comment->created_at->format('d/m/Y H:i:s')}}</span>
                                            @if(Auth::user() && ($comment->user_id == Auth::user()->id))
                                            <hr>
                                            <a href="#">
                                                <i class="lni-pencil"></i>
                                            </a>
                                            &nbsp;
                                            <a href="#" class="delete-comment" data-id="{{$comment->id}}">
                                                <i class="lni-trash"></i>
                                            </a>
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
                                ['frontend.comments.store'], 'autocomplete' =>
                                'on','id' => 'commentForm', 'class' => 'form-ad']) !!}
                                @csrf
                                <input type="hidden" value="{{$post->id}}" name="post_id">
                                <input type="hidden" value="{{$post->slug}}" name="post_slug">
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
        <script>
            if ($('#comment').hasClass('is-invalid')) {
                $('#comment').focus();
            }


            $(".delete-comment").click(function (e) {
                var id = $(this).data('id');
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger mr-3',
                    buttonsStyling: false,
                })
                e.preventDefault();
                swalWithBootstrapButtons({
                    title: 'Are you sure?',
                    text: 'You want to delete this comment?',
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        deleteComment(id);
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            'Cancelled',
                            'Your comment is safe :)',
                            'error'
                        )
                    }
                })
            });

            function deleteComment(comment_id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("input[name=_token]").val()
                    }
                });
                $.ajax({
                    url: '{{route("frontend.comments.index")}}/' + comment_id,
                    type: 'DELETE',
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data);
                        if (data.status == 1) {
                            let timerInterval
                            swal({
                                type: "success",
                                title: 'Please wait!',
                                html: 'Deleting your comment..',
                                timer: 500,
                                onOpen: () => {
                                    swal.showLoading()
                                    timerInterval = setInterval(() => {}, 100)
                                },
                                onClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                if (
                                    result.dismiss === swal.DismissReason.timer
                                ) {
                                    $('#row_' + comment_id).remove();
                                    swal.close();
                                }
                            });
                        } else {
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'An error has accured while trying to delete the comment!',
                            });
                        }
                    }
                });
            }

        </script>
        <!-- End Content -->
        @stop
    </div>
</div>
@stop
