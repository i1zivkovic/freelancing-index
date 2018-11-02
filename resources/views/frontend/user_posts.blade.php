@extends('layouts.frontend')

@section('title', 'My Posts')
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

                        @if($posts->count() <= 0) <div class="col-lg-12 col-md-12 col-xs-12 mb-2 text-center">
                                <h5>You have no posts posted so far.</h5>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 mb-2 text-center">
                            <a class="btn btn-common" href="{{route('frontend.posts.create')}}">Create a post</a>
                        </div>
                        @else

                        <div class="col-sm-12 text-center mb-5">
                            <h3>My Posts</h3>
                        </div>

                        <div class="col-lg-4 col-md-12 col-xs-12 mb-2">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                    <i class="lni-funnel"></i> Filter posts
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in show">
                                            <div class="panel-body">

                                                {!! Form::open(['route' => ['frontend.myPostsFilter'], 'role' => 'form',
                                                'autocomplete' => 'off',
                                                'files' => false, 'method' => 'get', 'id' => 'search-form']) !!}
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-xs-12 mb-3">
                                                        <input type="text" class="form-control" placeholder="Title keywords"
                                                            name="q" value="{{!empty($request) ? $request->input('q') : null}}">
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

                    <!-- Start Blog Posts -->
                    <div class="col-lg-8 col-md-12 col-xs-12">
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



                        <!-- Start Pagination -->
                        @if(empty($request))
                        {!! $posts -> links()!!}
                        @else
                        {{ $posts->appends($request->all())->links() }}
                        @endif
                        <!-- End Pagination -->

                    </div>
                    <!-- End Blog Posts -->
                    @endif
                </div>
            </div>
        </div>
        <!-- End Content -->


        @include('includes.frontend.loaderAndArrow')


        @section('js')
        {{-- --}}
        {!!Html::script(asset('js/custom/user-posts.js'))!!}

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
