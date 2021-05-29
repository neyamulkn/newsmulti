<?php

use Illuminate\Support\Facades\Route;

Route::get('reporter/login', 'Reporter\ReporterLoginController@LoginForm')->name('reporterLogin');
Route::post('reporter/login', 'Reporter\ReporterLoginController@login')->name('reporterLogin');
Route::post('reporter/logout', 'Reporter\ReporterLoginController@logout')->name('reporterLogout');

Route::get('reporter/register', 'Reporter\ReporterRegController@registerForm')->name('reporterRegister');
Route::post('reporter/register', 'Reporter\ReporterRegController@register')->name('reporterRegister');

//reset for
Route::get('reporter/password/recover', 'Auth\ForgotPasswordController@reporterPasswordRecover')->name('reporter.password.recover');
//forgot password notify send
Route::match(array('GET','POST'), 'reporter/password/recover/notify', 'Auth\ForgotPasswordController@reporterPasswordRecoverNotify')->name('reporter.password.recover');
//verify token or otp
Route::get('reporter/password/recover/verify', 'Auth\ForgotPasswordController@reporterPasswordRecoverVerify')->name('reporter.password.recoverVerify');
//passord update
Route::post('reporter/password/recover/update', 'Auth\ForgotPasswordController@reporterPasswordRecoverUpdate')->name('reporter.password.recoverUpdate');

 
// Authenticate routes & check role reporter
route::group(['middleware' => ['auth:reporter'], 'prefix' => 'reporter'], function(){

	//namespace 
	route::group(['namespace' => 'Reporter'], function(){

		Route::get('/', 'ReporterController@dashboard')->name('reporter.dashboard');

		//Bangla News Route
	    Route::get('news/create', 'ReporterNewsController@create')->name('reporter.news.create');
	    Route::post('news/store', 'ReporterNewsController@store')->name('reporter.news.store');
	    Route::get('news/edit/{news_slug}', 'ReporterNewsController@edit')->name('reporter.news.edit');
	    Route::post('news/update/{id}', 'ReporterNewsController@update')->name('reporter.news.update');
	   	Route::get('news/list/{status?}', 'ReporterNewsController@index')->name('reporter.news.list');
	   	Route::get('news/delete/{id}', 'ReporterNewsController@delete')->name('reporter.news.delete');

	   	Route::get('wallet', 'WalletController@walletHistory')->name('reporter.walletHistory');
		Route::post('wallet/withdraw/request', 'WalletController@withdrawRequest')->name('reporter.withdrawRequest');
	});
});


