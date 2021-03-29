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
Route::get('404', 'HomeController@error')->name('404');
Route::get('/feed', 'HomeController@feed')->name('feed');
Route::get('sitemap.xml','SitemapController@index');
Route::get('sitemap.xml/article','SitemapController@articles');
Route::get('sitemap.xml/category','SitemapController@categories');

Route::get('notifications', 'NotificationController@notifications')->name('notifications');
Route::get('notifications/read/{id}', 'NotificationController@readNotify')->name('readNotify');

//ajax route
Route::get('get_subcategoryBy_id/{id}', 'AjaxController@get_subcategoryBy_id')->name('get_subcategory');

Route::get('get_district/{id}', 'AjaxController@get_district')->name('get_district');

Route::get('get_upzilla/{id}', 'AjaxController@get_upzilla')->name('get_upzilla');


//deshjure search route  // for home page and sitebar
Route::get('deshjure_district/{id}', 'AjaxController@deshjure_district')->name('deshjure_district');
Route::get('deshjure_upzilla/{id}', 'AjaxController@deshjure_upzilla')->name('deshjure_upzilla');

Route::get('news/image/{path}', 'HomeController@watermark')->name('watermark');




Route::get('lang/{locale}', function ($locale){
	if($locale == 'en'){
		Session::put('locale', $locale);
	}else{
		Session::forget('locale');
	}
   
    return redirect('/');
});

//this route for news insert pages
Route::get('news/image-gallery', 'AjaxController@imageGallery')->name('imageGallery');
Route::get('news/video-gallery', 'AjaxController@videoGallery')->name('videoGallery');

Route::post('user/registration', 'UserController@registration')->name('registration');

Auth::routes();

include('adminRoutes.php');

Route::get('/', 'HomeController@index')->name('home');
Route::get('kalamadmin', 'UserController@login')->name('admin');
Route::post('registrationAndComment', 'CommentController@registrationAndComment')->name('registrationAndComment');
Route::post('userlogin', 'UserController@userlogin')->name('userlogin');

Route::match(['get', 'post'], 'category/{category}/{subcategory?}/{childCategory?}/{subchildCategory?}', ['uses' => 'HomeController@category', 'as' => 'category']);

Route::get('news/search', 'HomeController@search_news')->name('search_news');
Route::get('search', 'HomeController@search_result')->name('search_result');

Route::get('gallery', 'HomeController@gallery')->name('gallery');
Route::get('gallery/{category}', 'HomeController@gallery_category')->name('gallery.category');
Route::get('gallery/{category}/{slug}', 'HomeController@gallery_view')->name('gallery.view');

Route::get('video', 'HomeController@video')->name('video');
Route::get('video/watch/{slug}', 'HomeController@video_watch')->name('video.watch');

// news details page
Route::get('article/{slug}', 'HomeController@news_details')->name('news_details');
Route::get('artical/{slug}', 'HomeController@news_details')->name('news_details');
Route::get('news/readLater', 'UserController@readLater')->name('readLater')->middleware('auth');
Route::get('news/read-later/{username}', 'UserController@viewReadLater')->name('viewReadLater');
Route::get('comment/insert', 'CommentController@comment_insert')->name('comment_insert');
Route::post('comment/reply/{id}', 'CommentController@comment_reply')->name('comment_reply');
Route::get('comments/{slug}', 'CommentController@comments')->name('comments');

Route::get('comment/delete', 'CommentController@commentDelete')->name('commentDelete');



Route::get('{page}', 'HomeController@page')->name('page');

Route::get('repoter/{username}', 'HomeController@reporter_details')->name('reporter_details');

Route::get('profile/{username}', 'HomeController@user_profile')->name('user_profile');
Route::post('profile/update', 'UserController@update_profile')->name('update_profile');
Route::get('reporter/request', 'UserController@request_reporter')->name('request_reporter');

Route::post('reporter/request', 'UserController@insert_request_reporter')->name('request_reporter');

Route::get('social-login/redirect/{provider}', 'SocialLoginController@redirectToProvider')->name('social.login');
Route::get('social-login/{provider}/callback', 'SocialLoginController@handleProviderCallback')->name('social.callback');
