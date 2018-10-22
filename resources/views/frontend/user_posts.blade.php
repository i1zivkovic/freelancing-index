@extends('layouts.frontend')

@section('title', 'Posts')
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
                    <!--Sidebar-->
                    <aside id="sidebar" class="col-lg-12 col-md-12 col-xs-12">

                        <!-- Search Widget -->
                        <div class="widget">
                            <h5 class="widget-title">Search my posts</h5>
                            <div class="widget-search widget-box">
                                <form action="#">
                                    @csrf
                                    <input class="form-control search" type="search" placeholder="Enter your keyword" />
                                    <button class="search-btn" type="submit"><i class="lni-search"></i></button>
                                </form>
                            </div>
                        </div>


                        <!--  Posts counter widget -->
                        <div class="widget">
                            <h5 class="widget-title">No. of posts: {{$postCount}} </h5>
                        </div>


                    </aside>
                    <!--End sidebar-->
                    <!-- Start Blog Posts -->
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <!-- Start Post -->
                        @foreach($posts as $post)
                    <div class="blog-post" id="row_{{$post->id}}">
                            <!-- Post thumb -->
                            <div class="post-thumb">
                                <img class="img-responsive w-100" src="{{asset('img')}}/blog/blog1.jpg" alt="">
                                <div class="hover-wrap">
                                </div>
                            </div>
                            <!-- End Post post-thumb -->

                            <!-- Post Content -->
                            <div class="post-content">
                                <h3 class="post-title"><a href="{{route('frontend.posts.show',['slug' => $post->slug])}}">{{$post->title}}</a></h3>
                                <div class="meta">
                                    <span class="meta-part"><i class="lni-calendar"></i>
                                        {{$post->created_at->format('d/m/Y H:i:s')}}</span>
                                    <span class="meta-part"><i class="lni-heart-filled"></i>
                                        {{$post->post_likes_count}} Likes</span>
                                    <span class="meta-part"><i class="lni-comments-alt"></i>
                                        {{$post->post_comments_count}} Comments</span>
                                </div>
                                <p>{{$post->description}}</p>
                             {{--    <a href="{{route('frontend.posts.show',['slug' => $post->slug])}}" class="btn btn-common">Read
                                    More</a> --}}
                                <hr>
                                @if(Auth::user() && ($post->user_id == Auth::user()->id))
                             <a href="{{route('frontend.posts.edit',['id' => $post->id])}}">
                                    <i class="lni-pencil"></i>
                                </a>
                                &nbsp;
                                <a href="#" class="delete-post" data-id="{{$post->id}}">
                                    <i class="lni-trash"></i>
                                </a>
                                @endif
                            </div>
                            <!-- Post Content -->

                        </div>
                        @endforeach
                        <!-- End Post -->


                        {!! $posts -> links()!!}

                    </div>
                    <!-- End Blog Posts -->
                </div>
            </div>
        </div>
        <!-- End Content -->


        @include('includes.frontend.loaderAndArrow')


        @section('js')
        {{-- --}}
        <script>
        if ($('#comment').hasClass('is-invalid')) {
            $('#comment').focus();
        }


        $(".delete-post").click(function (e) {
            var id = $(this).data('id');
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mr-3',
                buttonsStyling: false,
            })
            e.preventDefault();
            swalWithBootstrapButtons({
                title: 'Are you sure?',
                text: 'You want to delete this post?',
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    deletePost(id);
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelled',
                        'Your post is safe :)',
                        'error'
                    )
                }
            })
        });

        function deletePost(post_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("input[name=_token]").val()
                }
            });
            $.ajax({
                url: '{{route("frontend.posts.index")}}/' + post_id,
                type: 'DELETE',
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if (data.status == 1) {
                        let timerInterval
                        swal({
                            type: "success",
                            title: 'Please wait!',
                            html: 'Deleting your post..',
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
                                $('#row_' + post_id).remove();
                                swal.close();
                            }
                        });
                    } else {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'An error has accured while trying to delete the post!',
                        });
                    }
                }
            });
        }

    </script>
        @stop
    </div>
</div>
@stop