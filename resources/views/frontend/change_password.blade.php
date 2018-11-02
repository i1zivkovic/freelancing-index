@extends('layouts.frontend')

@section('title', 'Change Password')
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
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="right-sideabr">
                        <h4>Profile</h4>
                        <ul class="list-item">
                            <li><a href="resume.html">Info</a></li>
                            {{-- <li><a href="bookmarked.html">Bookmarked Jobs</a></li>
                            <li><a href="bookmarked.html">Bookmarked Posts</a></li> --}}
                            <li><a href="notifications.html">Notifications <span class="notinumber">2</span></a></li>
                            <li><a href="manage-applications.html">Manage Applications</a></li>
                            <li><a href="job-alerts.html">Job Alerts</a></li>
                            <li><a href="{{route('frontend.changePassword')}}">Change Password</a></li>
                            <li><a href="index.html">Sing Out</a></li>
                        </ul>
                  </div>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <div class="job-alerts-item">
                    <h3 class="alerts-title">Change Password</h3>
                    <form class="form">
                      <div class="form-group is-empty">
                        <label class="control-label">Old Password*</label>
                        <input class="form-control" type="text">
                        <span class="material-input"></span>
                      </div>
                      <div class="form-group is-empty">
                        <label class="control-label">New Password*</label>
                        <input class="form-control" type="text">
                        <span class="material-input"></span>
                      </div>
                      <div class="form-group is-empty">
                        <label class="control-label">Confirm New Password*</label>
                        <input class="form-control" type="text">
                        <span class="material-input"></span>
                      </div>
                      <a href="#" id="submit" class="btn btn-common">Save</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Content -->



        @include('includes.frontend.loaderAndArrow')
        @section('js')
        @stop
    </div>
</div>
@stop
