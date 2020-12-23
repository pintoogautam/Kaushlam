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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'PostController@index');
Route::resource('posts', 'PostController');
// route to show the product list
Route::get('/', array('uses' => 'HomeController@ProductList'));

// route to show the login form
Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form from USER
Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('logout', array('uses' => 'HomeController@doLogout'));

Route::get('/register', 'HomeController@register');

Route::post('/register', 'HomeController@signup');

Route::get('activation/{key}', 'Auth\RegisterController@activation');

Route::get('/myhome', 'UserController@myhome');

Route::get('/update-profile', 'UserController@editProfile');

Route::post('/update-account', 'UserController@updateAccount');

Route::post('/update-password', 'UserController@updatePassword');

Route::post('/update-profile', 'UserController@updateProfile');

Route::post('/update-wordk-detail', 'UserController@updateWorkDetail');

