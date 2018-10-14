@extends('layouts.frontend')

@section('title', 'Step Two')
@section('description', "")

@section('css')
{{-- --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')


<!-- Content section Start -->
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-12 col-xs-12">
                <div class="post-job box">
                    {!! Form::open(['method' => 'POST', 'route' => ['frontend.postStepTwo'], 'autocomplete' => 'on',
                    'files' => true, 'enctype' => 'multipart/form-data', 'id' => 'postForm', 'class' => 'form-ad']) !!}
                    <h3>Add your skills</h3>
                    <p class="mb-5">Feel free to add your skills now, or you can click on NEXT and do it later on your profile settings.</p>
                    <select class="js-data-example-ajax" id="tag_list" multiple="multiple" name="tag_list[]"></select>
                    <button type="submit" class="btn btn-common mt-5">Next</button>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Content section End -->


@stop

@section('js')
{{-- --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $('#tag_list').select2({

        width: '100%',
        placeholder: "Choose tags...",
        minimumInputLength: 2,
        ajax: {
            delay: 300,
            url: 'skills/find',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

</script>
@stop
