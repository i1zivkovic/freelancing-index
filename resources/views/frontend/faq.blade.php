@extends('layouts.frontend')

@section('title', 'FAQ')
@section('description', "")

@section('css')
{{-- --}}
@stop

@section('content')

<div class="">
    <div class="space-100">


        <div id="faq" class="section pb-45">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 text-center mb-5">
                        <h3>Frequently asked questions</h3>
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <!-- accordion start -->
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            Are job ads free to post?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <p>Job ads are free and they always will be no matter how many of them you want
                                            to post.</p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            Who should I to contact if I have any question?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                            You can always go to our CONTACT page and fill out a form for an easy way
                                            or you can send us an e-mail to <a href="mailto:ivanzivkovic1601@gmail.com">ivanzivkovic1601@gmail.com</a>. We will try our best to respond as soon as possible.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                            How can I cancel my job application?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                            You can go to 'My Applications' page under the 'Work' dropdown and press the 'Cancel application' button or you can do it from the specific job details page.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                            How many files are allowed per job ad?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                            Only 1.
                                            <br>
                                             Any editing that includes new file upload will overwrite the old one.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- accordion End -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <!-- accordion start -->
                        <div class="panel-group" id="accordion1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2">
                                           How can I post a job ad?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                           You can go to the 'Post a job ad' page under the 'Recurit' dropdown. Once there, you should fill out a form about job details and post it.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree3">
                                            How am I notified I someone applies to my job?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                            You will receive and e-mail from us <ivanzivkovic1601@gmail.com> with the subject of 'Job Application' which will contain the neccessary info. You can also view applications for your jobs from the 'Manage applications' page under the 'Recurit' dropdown.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour4">
                                            How can I apply to a job?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                            First you need to navigate to specific job details page. Once there you will find the 'Apply button'. Clicking on it will lead you to another page where you enter you comment and submit it.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive5">
                                            How can I help out this page?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>
                                            We're in a process of creating a pateron page or donations. Once done, you can help us out that way.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- accordion End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->


        @include('includes.frontend.loaderAndArrow')

        @section('js')
        {{-- --}}
        @stop
    </div>
</div>
@stop
