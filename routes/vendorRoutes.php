<?php

use Illuminate\Support\Facades\Route;

Route::get('seller/login', 'Vendor\VendorLoginController@LoginForm')->name('vendorLoginForm');
Route::post('seller/login', 'Vendor\VendorLoginController@login')->name('vendorLogin');
Route::get('seller/logout', 'Vendor\VendorLoginController@logout')->name('vendorLogout');

Route::get('seller/register', 'Vendor\VendorRegController@registerForm')->name('vendorRegisterForm');
Route::post('seller/register', 'Vendor\VendorRegController@register')->name('vendorRegister');

//reset for
Route::get('seller/password/recover', 'Auth\ForgotPasswordController@sellerPasswordRecover')->name('seller.password.recover');
//forgot password notify send
Route::match(array('GET','POST'), 'seller/password/recover/notify', 'Auth\ForgotPasswordController@sellerPasswordRecoverNotify')->name('seller.password.recover');
//verify token or otp
Route::get('seller/password/recover/verify', 'Auth\ForgotPasswordController@sellerPasswordRecoverVerify')->name('seller.password.recoverVerify');
//passord update
Route::post('seller/password/recover/update', 'Auth\ForgotPasswordController@sellerPasswordRecoverUpdate')->name('seller.password.recoverUpdate');



