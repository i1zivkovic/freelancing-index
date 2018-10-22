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
                <aside id="sidebar" class="col-lg-4 col-md-12 col-xs-12">

                  <!-- Search Widget -->
                  <div class="widget">
                    <h5 class="widget-title">Search This Site</h5>
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
                            <h5 class="widget-title"># of posts: {{$postCount}} </h5>
                          </div>

                  <!-- Categories Widget -->
                 {{--  <div class="widget ">
                    <h5 class="widget-title">Categories</h5>
                    <div class="widget-categories widget-box">
                      <ul class="cat-list">
                        <li>
                          <a href="#">Announcement <span class="num-posts">(4)</span></a>
                        </li>
                        <li>
                          <a href="#">Indeed Events <span class="num-posts">(2)</span></a>
                        </li>
                        <li>
                          <a href="#">Tips & Tricks <span class="num-posts">(3)</span></a>
                        </li>
                        <li>
                          <a href="#">Experiences <span class="num-posts">(5)</span></a>
                        </li>
                        <li>
                          <a href="#">Case Studies <span class="num-posts">(6)</span></a>
                        </li>
                        <li>
                          <a href="#">Labor Market News <span class="num-posts">(9)</span></a>
                        </li>
                        <li>
                          <a href="#">HR Best Practices <span class="num-posts">(17)</span></a>
                        </li>
                      </ul>
                    </div>
                  </div> --}}

                  <!-- Recent Posts widget -->
                  <div class="widget">
                    <h5 class="widget-title">Recent Posts</h5>
                    <div class="widget-popular-posts widget-box">
                      <ul class="posts-list">
                          @forEach($recentPosts as $recentPost)
                        <li>
                          <div class="widget-content">
                          <a href="{{route('frontend.posts.show',['slug' => $recentPost->slug])}}">{{$recentPost->title}}</a>
                            <span><i class="lni-calendar"></i> {{$recentPost->created_at->format('d/m/Y H:i:s')}}</span>
                            <span><i class="lni-user"></i> {{$recentPost->user->username}}</span>
                          </div>
                          <div class="clearfix"></div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>

                  <!-- Tag Media -->
                  {{-- <div class="widget">
                    <h5 class="widget-title">Tags</h5>
                    <div class="tag widget-box">
                      <a href="#"> Jobpress</a>
                      <a href="#"> Recruiter</a>
                      <a href="#"> Interview</a>
                      <a href="#"> Employee</a>
                      <a href="#"> Labor</a>
                      <a href="#"> HR</a>
                      <a href="#"> Salary</a>
                      <a href="#"> Employer</a>
                    </div>
                  </div> --}}

                  <!-- Archives Widget -->
                {{--   <div class="widget">
                    <h5 class="widget-title">Archives</h5>
                    <div class="widget-archives widget-box">
                      <ul class="cat-list">
                        <li>
                          <a href="#">October 2016 <span class="num-posts">(29)</span></a>
                        </li>
                        <li>
                          <a href="#">September 2016 <span class="num-posts">(34)</span></a>
                        </li>
                        <li>
                          <a href="#">August 2016 <span class="num-posts">(23)</span></a>
                        </li>
                        <li>
                          <a href="#">July 2016 <span class="num-posts">(38)</span></a>
                        </li>
                        <li>
                          <a href="#">June 2016 <span class="num-posts">(16)</span></a>
                        </li>
                        <li>
                          <a href="#">May 2016 <span class="num-posts">(14)</span></a>
                        </li>
                        <li>
                          <a href="#">April 2016 <span class="num-posts">(17)</span></a>
                        </li>
                      </ul>
                    </div>
                  </div> --}}
                </aside>
                <!--End sidebar-->
                <!-- Start Blog Posts -->
                <div class="col-lg-8 col-md-12 col-xs-12">
                  <!-- Start Post -->
                  @foreach($posts as $post)
                <div class="blog-post" id="row_{{$post->id}}">
                    <!-- Post thumb -->
                    <div class="post-thumb">
                      <a href="#"><img class="img-fulid" src="{{asset('img')}}/blog/blog1.jpg" alt=""></a>
                      <div class="hover-wrap">
                      </div>
                    </div>
                    <!-- End Post post-thumb -->

                    <!-- Post Content -->
                    <div class="post-content">
                    <h3 class="post-title"><a href="{{route('frontend.posts.show',['slug' => $post->slug])}}">{{$post->title}}</a></h3>
                      <div class="meta">
                        <span class="meta-part"><a href="{{route('frontend.user.show',['slug' => $post->user->slug])}}"><i class="lni-user"></i> By {{$post->user->username}}</a></span>
                        <span class="meta-part"><i class="lni-calendar"></i> {{$post->created_at->format('d/m/Y H:i:s')}}</span>
                        <span class="meta-part"><i class="lni-heart-filled"></i>  {{$post->post_likes_count}} Likes</span>
                        <span class="meta-part"><i class="lni-comments-alt"></i> {{$post->post_comments_count}} Comments</span>
                      </div>
                      <p>{{$post->description}}</p>

                      @if(Auth::user() && ($post->user_id == Auth::user()->id))
                      <hr>
                      <a href="#">
                          <i class="lni-pencil"></i>
                      </a>
                      &nbsp;
                      <a href="#" class="delete-post" data-id="{{$post->id}}">
                          <i class="lni-trash"></i>
                      </a>
                      @endif
                   {{--    <a href="{{route('frontend.posts.show',['slug' => $post->slug])}}" class="btn btn-common">Read More</a> --}}
                    </div>
                    <!-- Post Content -->

                  </div>
                  @endforeach
                  <!-- End Post -->



                  <!-- Start Pagination -->
                {{--   <ul class="pagination">
                    <li class="active"><a href="#" class="btn-prev" ><i class="lni-angle-left"></i> prev</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li class="active"><a href="#" class="btn-next">Next <i class="lni-angle-right"></i></a></li>
                  </ul> --}}
                  <!-- End Pagination -->

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
