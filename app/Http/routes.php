<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['middleware' => 'githubauth'], function () {
    Route::get('/api/users/{username}/repos', 'MainController@getUserRepos')->where("username", ".*");

    Route::get('/api/users/{username}', 'MainController@getUserInfo')->where("username", ".*");
});

Route::get("/{all}", 'MainController@responseError')->where('all', '.*');

