<?php

use Illuminate\Support\Facades\Route;

Route::get('login', 'LoginController@LoginForm')->name('LoginForm');
Route::post('login', 'LoginController@login')->name('userLogin');
Route::get('register', 'User\UserRegController@RegisterForm')->name('userRegisterForm');
Route::post('user/register', 'User\UserRegController@register')->name('userRegister');
Route::get('logout', 'Auth\LoginController@logout')->name('userLogout');
Route::get('resend/account/verify', 'User\UserRegController@resendVerifyToken')->name('resendVerifyToken');
Route::get('account/verify', 'User\UserRegController@userAccountVerify')->name('userAccountVerify');

//reset for
Route::get('password/recover', 'Auth\ForgotPasswordController@passwordRecover')->name('password.recover');
//forgot password notify send
Route::match(array('GET','POST'), 'password/recover/notify', 'Auth\ForgotPasswordController@passwordRecoverNotify')->name('password.recover');
//verify token or otp
Route::get('password/recover/verify', 'Auth\ForgotPasswordController@passwordRecoverVerify')->name('password.recoverVerify');
//passord update
Route::post('password/recover/update', 'Auth\ForgotPasswordController@passwordRecoverUpdate')->name('password.recoverUpdate');

route::group(['middleware' => ['auth']], function(){

	route::group(['prefix' => 'user', 'namespace' => 'User'], function(){
		//user account
		Route::get('dashboard', 'UserController@dashboard')->name('user.dashboard');
		Route::get('profile', 'UserController@myProfile')->name('user.myProfile');
		Route::post('profile/update', 'UserController@profileUpdate')->name('user.profileUpdate');
		Route::post('address/update', 'UserController@addressUpdate')->name('user.addressUpdate');
		Route::get('change-password', 'UserController@changePasswordForm')->name('user.change-password');
		Route::post('change-password', 'UserController@changePassword')->name('user.change-password');
		//profile image change for all user
		Route::post('change/profile/image', 'UserController@changeProfileImage')->name('changeProfileImage');
		Route::get('news/add/read-later', 'UserController@addedReadLater')->name('addedReadLater');
		Route::get('news/read-later', 'UserController@viewReadLater')->name('viewReadLater');
	});

	Route::get('comment/insert', 'CommentController@comment_insert')->name('comment_insert');
	Route::post('comment/reply/{id}', 'CommentController@comment_reply')->name('comment_reply');
	Route::get('comment/delete', 'CommentController@commentDelete')->name('commentDelete');


});





