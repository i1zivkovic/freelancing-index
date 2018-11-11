@extends('layouts.frontend')

@section('title', 'Update post')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')
<div class="">
    <div class="space-100">


        <!-- Content section Start -->
        <section id="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-md-12 col-xs-12">
                        <div class="col-sm-12 text-center mb-5">
                            <h3>Edit your post</h3>
                        </div>
                        <div class="post-job box">
                            {!! Form::open(['method' => 'PUT', 'route' => ['frontend.posts.update', $post->id],
                            'autocomplete' =>
                            'off',
                            'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'postStoreForm', 'class' =>
                            'form-ad']) !!}
                            @csrf
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    placeholder="" name="title" value="{{$post->title}}">
                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
                                    placeholder="" name="description" rows="7">{{$post->description}}</textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label">Upload File (will create new or overwrite existing)</label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label form-control {{ $errors->has('file') ? ' is-invalid' : '' }}"
                                        for="file" id="file-label">
                                        Choose file...
                                    </label>
                                    @if ($errors->has('file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Uploaded File</label>
                                @if ($post->post_files)
                                <div class="form-group">
                                    <p id="file-info"> <a href="{{asset('uploads')}}/{{Auth::user()->username}}/posts/{{$post->id}}/{{$post->post_files->path}}"
                                            download>{{$post->post_files->path}}</a> <a href="#!" class="text-danger"
                                            id=""></a></p>
                                </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-common mt-5">Update</button>
                            {!!Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section End -->


        @include('includes.frontend.loaderAndArrow')


        @section('js')
        {{-- --}}

        {!!Html::script(asset('js/custom/job-create.js'))!!}
        @stop
    </div>
</div>
@stop
