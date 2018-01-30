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

Route::get('/', function () {
    return view('welcome');
});


// Authentication routes
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Password reset routes
Route::post(
    '/password/email',
    'Auth\ForgotPasswordController@sendResetLinkEmail'
)->name('password.email');

Route::get(
    '/password/reset',
    'Auth\ForgotPasswordController@showLinkRequestForm'
)->name('password.request');

Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

Route::get(
    '/password/reset/{token}',
    'Auth\ResetPasswordController@showResetForm'
)->name('password.reset');

// Registration routes.
Route::get('/register',
    'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register',
    'Auth\RegisterController@registerMember')->name('register');

// Dashboard routes
Route::get('/home', 'HomeController@index')->name('home');

Route::get(
    '/profile',
    'Member\ProfileController@showProfileForm'
)->name('profile');

Route::post('/profile', 'Member\ProfileController@updateProfile');
