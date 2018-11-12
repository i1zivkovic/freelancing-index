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


Auth::routes(/* ['verify' => true] */);

// ALLOWED ROUTES TO EVERYONE
Route::group(['prefix' => '/', 'namespace' => 'Frontend', 'as' => 'frontend.'], function () {


});



// ROUTES ONLY FOR REGISTERED USERS WHICH HAVE FILLED BASE INFO
Route::group(['prefix' => '/', 'namespace' => 'Frontend', 'as' => 'frontend.', 'middleware' => [/* 'verified', */'auth','steps']], function () {

    //HOME
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/faq', 'HomeController@faq')->name('faq');
    Route::get('/about-us', 'HomeController@about')->name('about');

    //PROFILE COMPLETION STEPS
    Route::get('step-1', 'StepController@getStepOne')->name('getStepOne');
    Route::get('step-2', 'StepController@getStepTwo')->name('getStepTwo');
    Route::post('post-step-2', 'StepController@postStepTwo')->name('postStepTwo');


    //COMMUNITY
    Route::get('users', 'CommunityController@index')->name('getUsers');
    Route::get('show-followers', 'CommunityController@show_followers')->name('showFollowers');
    Route::get('show-following', 'CommunityController@show_following')->name('showFollowing');
    //FOLLOW / UNFOLLOW
    Route::post('follow-unfollow/{id}', 'CommunityController@follow_unfollow')->name('followUnfollow');
    Route::any('users-filter', 'CommunityController@users_filter')->name('usersFilter');
    Route::any('followers-filter', 'CommunityController@followers_filter')->name('followersFilter');
    Route::any('following-filter', 'CommunityController@following_filter')->name('followingFilter');



    //AJAX
    Route::get('skills/find', 'AjaxController@findSkill');


    //PROFILE
    Route::get('profile/{slug}', 'UserController@show')->name('user.show');
    Route::get('profile-edit/{slug}', 'UserController@profile_edit')->name('profileEdit');
    //PROFILE EDIT
    Route::post('profile-experience', 'ProfileController@update_profile_experience')->name('profileExperience');
    Route::post('profile-education', 'ProfileController@update_profile_education')->name('profileEducation');
    Route::post('profile-info', 'ProfileController@update_profile_info')->name('profileInfo');
    Route::post('account-info', 'ProfileController@update_account_info')->name('accountInfo');
    Route::post('skills-info', 'ProfileController@skills_update')->name('skillsInfo');
    Route::post('socials-info', 'ProfileController@socials_update')->name('socialsInfo');
    Route::post('location-info', 'ProfileController@location_update')->name('locationInfo');

    //POSTS
    Route::resource('posts', 'PostController');
    Route::get('posts/my-posts/{slug}', 'PostController@getMyPosts')->name('myPosts');
    Route::get('posts-explore', 'PostController@explore')->name('posts.explore');
    Route::any('posts-filter', 'PostController@postPostFilter')->name('postsFilter');
    Route::any('my-posts-filter', 'PostController@postMyPostFilter')->name('myPostsFilter');
    Route::any('explore-filter', 'PostController@postPostExploreFilter')->name('postExploreFilter');
    //POST LIKES
    Route::post('post-likes/{id}', 'PostLikeController@likeUnlikeHandler')->name('postLikeUnlike');
    //POST COMMENTS
    Route::resource('post-comments', 'PostCommentController');


    //JOBS
    Route::resource('jobs', 'JobController');
    Route::any('jobs-filter', 'JobController@postJobsFilter')->name('jobsFilter');
    Route::any('my-jobs-filter', 'JobController@postMyJobsFilter')->name('myJobsFilter');
    Route::get('posts/my-jobs/{slug}', 'JobController@getMyJobs')->name('myJobs');
    Route::delete('delete-job-file', 'AjaxController@deleteJobFile')->name('deleteJobFile');
    //JOB LIKES
    Route::post('job-likes/{id}', 'JobLikeController@likeUnlikeHandler')->name('jobLikeUnlike');
    //JOB COMMENTS
    Route::resource('job-comments', 'JobCommentController');
    //JOB APPLICATIONS
    Route::resource('job-applications', 'JobApplicationController');
    Route::get('user-applications', 'JobApplicationController@userApplications')->name('getUserApplications');
    Route::get('manage-applications', 'JobApplicationController@manageApplications')->name('getManageApplications');
    Route::get('manage-applications/{slug}', 'JobApplicationController@manageApplicationsSlug')->name('getManageApplicationsSlug');



    //RATINGS
    Route::resource('user-ratings','UserRatingController');


    //CONTACT
    Route::get('contact', 'ContactController@index')->name('contact');
    Route::post('contact', 'ContactController@sendMail')->name('sendMail');


    // PASSWORD CHANGE
    Route::get('change-password', 'PasswordController@index')->name('changePassword');
});


// ROUTE USED TO FILL BASE INFO WITHOUT REDIRECT
Route::group(['prefix' => '/', 'namespace' => 'Frontend', 'as' => 'frontend.', 'middleware' => ['auth']], function () {
    //PROFILE COMPLETION STEPS
    Route::any('post-step-1', 'StepController@postStepOne')->name('postStepOne');
});




// BACKEND TODO
Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'as' => 'backend.', 'middleware' => ['auth']], function () {

});





