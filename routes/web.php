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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//user logout
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::resource('admin/hostels', 'HostelController');
Route::resource('admin/rooms', 'RoomController');

//bed
Route::get('admin/bed/edit', 'RoomController@bedEdit')->name('bed.edit');
Route::post('admin/bed/update', 'RoomController@bedUpdate')->name('bed.update');


//we can group  all our sllag admin so we dont have to do /admin/login
Route::prefix('admin')->group(function(){
	//show login form
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	//ogin  admin
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	//after successful login
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	//logout admin
	Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	
	
	//1.shows the form for the user to put in his email for password reset, sent from the admin forgot password login
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	//2.sends user the reset email link to the users email address
	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	//3.show the form with new password and old password (coming from your email address)
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
	//4.resets the password and log user in(called from the url from the email)
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
	
});