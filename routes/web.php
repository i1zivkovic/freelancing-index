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

Route::group(['prefix' => '/', 'namespace' => 'Frontend', 'as' => 'frontend.', 'middleware' => ['auth','steps']], function () {

    //HOME PAGE
    Route::get('/', 'HomeController@index')->name('home');
    //


    //PROFILE COMPLETION STEPS
    Route::get('step-1', 'StepController@getStepOne')->name('getStepOne');
    Route::get('step-2', 'StepController@getStepTwo')->name('getStepTwo');
    Route::post('post-step-2', 'StepController@postStepTwo')->name('postStepTwo');
    //

    //CONTACT PAGE
    Route::get('contact', 'ContactController@index')->name('contact');
    //

    //AJAX
    Route::get('skills/find', 'AjaxController@find');
    //


    //PROFILE
    Route::get('profile', 'UserController@getProfile')->name('getProfile');
    //


    //POSTS
    Route::get('posts', 'PostController@index')->name('posts');
    //
});

Route::group(['prefix' => '/', 'namespace' => 'Frontend', 'as' => 'frontend.', 'middleware' => ['auth']], function () {
    //PROFILE COMPLETION STEPS
    Route::post('post-step-1', 'StepController@postStepOne')->name('postStepOne');
});



Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'as' => 'backend.', 'middleware' => ['auth']], function () {

});





