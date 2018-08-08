<?php

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//user logout
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');


Route::prefix('student')->group(function(){
	//hostel allocation
	Route::get('/allocate', 'AllocateController@index')->name('allocate.index');
	Route::get('/allocate/getRooms', 'AllocateController@getRooms')->name('allocate.getrooms');
	Route::get('/allocate/getbed', 'AllocateController@getBed')->name('allocate.getBed');
	Route::get('/allocate/check', 'AllocateController@check')->name('allocate.check');
	Route::post('/allocate', 'AllocateController@allocate')->name('allocate.allocate');
	Route::get('/profile/{id}', 'HomeController@showProfile')->name('profile.show');
	
	
	Route::post('/message', 'studentMessageController@stdStore')->name('stdmsg.store');
	Route::get('/message/{id}', 'studentMessageController@stdShow')->name('stdmsg.show');
	Route::post('/message/read', 'studentMessageController@stdRead')->name('stdmsg.read');
	Route::post('/message/sentdel', 'studentMessageController@stdSentdel')->name('stdmsg.sentdel');
	Route::post('/message/recdel', 'studentMessageController@stdRecdel')->name('stdmsg.recdel');
	
});

Route::get('/mail', function () {
	$mail = App\Allocate::where('user_id', 1)->first();
	
	return new App\Mail\AllocatesEmail($mail);
});




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
	
	//admin activities
	Route::get('/administrators', 'AdminController@showAdmins')->name('admin.admins');
	Route::post('/create', 'AdminController@createAdmin')->name('admin.create');
	
	
	//1.shows the form for the user to put in his email for password reset, sent from the admin forgot password login
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	//2.sends user the reset email link to the users email address
	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	//3.show the form with new password and old password (coming from your email address)
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
	//4.resets the password and log user in(called from the url from the email)
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
	
	Route::resource('/hostels', 'HostelController');
	Route::resource('/rooms', 'RoomController');
	
	Route::get('/student/{id}', 'AdminStudentController@allStudents')->name('admin.student.all');
	Route::get('/student/show/{id}', 'AdminStudentController@showStudent')->name('admin.student.show');
	Route::post('/student/search/', 'AdminStudentController@searchStudent')->name('admin.student.search');
	Route::get('/notifications', 'AdminStudentController@notifyIndex')->name('admin.notifyindex');
	Route::post('/notifyCreate', 'AdminStudentController@notifyCreate')->name('admin.notifycreate');
	Route::delete('/notifyDelete/{id}', 'AdminStudentController@notifyDelete')->name('admin.notifydelete');
	
	//bed
	Route::get('/bed/edit', 'RoomController@bedEdit')->name('bed.edit');
	Route::post('/bed/update', 'RoomController@bedUpdate')->name('bed.update');
	Route::put('/rooms/updatephoto/{id}', 'RoomController@updatephoto');
	
	//complains
	Route::get('/message', 'AdminMessageController@adminindex')->name('adminmsg.index');
	Route::get('/message/{id}/{user_id}', 'AdminMessageController@adminshow')->name('adminmsg.show');
	Route::delete('/message/{id}', 'AdminMessageController@admindestroy')->name('adminmsg.destroy');
	Route::post('/message/reply', 'AdminMessageController@adminreply')->name('adminmsg.reply');
	Route::post('/message/send', 'AdminMessageController@adminsend')->name('adminmsg.send');
	Route::get('/message/view', 'AdminMessageController@viewReply')->name('adminmsg.viewreply');
	
	//reports
	Route::get('/report', 'ReportController@index')->name('report.index');
	Route::get('/report/{id}', 'ReportController@report')->name('report.report');
});