@extends('layouts.frontend')

@section('title', 'Posts')
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
                        <div class="post-job box">
                            {!! Form::open(['method' => 'POST', 'route' => ['frontend.posts.store'], 'autocomplete' =>
                            'off',
                            'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'postStoreForm', 'class' =>
                            'form-ad']) !!}
                             @csrf
                            <h3>Create new post</h3>
                            <div class="form-group mt-5">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" placeholder="" name="title">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" placeholder="" name="description"
                                    rows="7"></textarea>
                            </div>
                         {{--    <div class="form-group">
                                <div class="button-group">
                                    <div class="action-buttons">
                                        <div class="upload-button">
                                            <button class="btn btn-common">Upload images</button>
                                            <input id="image" type="file" name="image" value="{{old('image')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="button-group">
                                    <div class="action-buttons">
                                        <div class="upload-button">
                                            <button class="btn btn-common">Upload files</button>
                                            <input id="image" type="file" name="image" value="{{old('image')}}">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-common mt-5">Create</button>
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
        @stop
    </div>
</div>
@stop
