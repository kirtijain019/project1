<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

 Route::get('/user', function ()
 {
    return view('user/user_welcome');
 });
 Route::get('user_signup','UserController@signupform');
 Route::post('user_signme','UserController@signme');
 Route::get('user_login','UserController@loginform');
 Route::get('user_profile','UserController@getprofile');
 Route::post('user_loginme','UserController@checklogin');
 Route::get('user_logout','UserController@logout');
 
 Route::get('quiz1', function ()
 {
    return view('user/quiz_questions/quiz1');
 });
 Route::post('grade','UserController@checkgrade');
  
Route::get('user_back','UserController@backfunction');



 Route::get('/admin', function ()
 {
    return view('admin/admin_welcome');
 });
 Route::get('admin_login','AdminController@loginform');
 Route::get('admin_profile','AdminController@getprofile'); 
 Route::post('admin_loginme','AdminController@checklogin');
 Route::get('admin_logout','AdminController@logout');
 Route::get('admin_back','AdminController@backfunction');






