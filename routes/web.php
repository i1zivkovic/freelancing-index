<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// ALLOWED ROUTES TO EVERYONE
Route::group(['prefix' => '/', 'namespace' => 'Frontend', 'as' => 'frontend.'], function () {


});



// ROUTES ONLY FOR REGISTERED USERS WHICH HAVE FILLED BASE INFO
Route::group(['prefix' => '/', 'namespace' => 'Frontend', 'as' => 'frontend.', 'middleware' => ['auth','steps']], function () {

        //HOME
        Route::get('/', 'HomeController@index')->name('home');

    //PROFILE COMPLETION STEPS
    Route::get('step-1', 'StepController@getStepOne')->name('getStepOne');
    Route::get('step-2', 'StepController@getStepTwo')->name('getStepTwo');
    Route::post('post-step-2', 'StepController@postStepTwo')->name('postStepTwo');
    //

    //CONTACT PAGE
    Route::get('contact', 'ContactController@index')->name('contact');
    //

    //AJAX
    Route::get('skills/find', 'AjaxController@findSkill');
    //


    //PROFILE
    Route::get('profile/{slug}', 'UserController@show')->name('user.show');
    //


    //POSTS
    Route::resource('posts', 'PostController');
    Route::get('posts/my-posts/{slug}', 'PostController@getMyPosts')->name('myPosts');
    Route::any('posts-filter', 'PostController@postPostFilter')->name('postsFilter');
    Route::any('my-posts-filter', 'PostController@postMyPostFilter')->name('myPostsFilter');
    //

    //POST COMMENTS
    Route::resource('post-comments', 'PostCommentController');
    //

    //POST COMMENTS
    Route::resource('job-comments', 'JobCommentController');
    //

    //JOBS
    Route::resource('jobs', 'JobController');
    Route::any('jobs-filter', 'JobController@postJobsFilter')->name('jobsFilter');
    Route::any('my-jobs-filter', 'JobController@postMyJobsFilter')->name('myJobsFilter');
    Route::get('posts/my-jobs/{slug}', 'JobController@getMyJobs')->name('myJobs');
    Route::delete('delete-job-file/{id}', 'AjaxController@deleteJobFile')->name('deleteJobFile');
    //


    //CONTACT
    Route::post('contact', 'ContactController@sendMail')->name('sendMail');
    //


    // PASSWORD CHANGE
    Route::get('change-password', 'PasswordController@index')->name('changePassword');
});


// ROUTE USED TO FILL BASE INFO WITHOUT REDIRECT
Route::group(['prefix' => '/', 'namespace' => 'Frontend', 'as' => 'frontend.', 'middleware' => ['auth']], function () {
    //PROFILE COMPLETION STEPS
    Route::post('post-step-1', 'StepController@postStepOne')->name('postStepOne');
});




// BACKEND TODO
Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'as' => 'backend.', 'middleware' => ['auth']], function () {

});





