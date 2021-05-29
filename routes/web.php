<?php
use Illuminate\Support\Facades\Route;

define('ADMIN', 1);
define('REPORTER', 2);
define('USER', 3);
define('STAFF', 4);

Route::get('404', 'HomeController@error')->name('404');
Route::get('/feed', 'HomeController@feed')->name('feed');
Route::get('sitemap','SitemapController@index');
Route::get('sitemap.xml','SitemapController@index')->name('sitemap');
Route::get('sitemap.xml/pages','SitemapController@pages');
Route::get('sitemap.xml/articles','SitemapController@articles');
Route::get('sitemap.xml/categories','SitemapController@categories');


Route::get('notifications', 'NotificationController@notifications')->name('notifications');
Route::get('notifications/read/{id}', 'NotificationController@readNotify')->name('readNotify');


//deshjure search route  // for home page and sitebar
Route::get('deshjure_district/{id}', 'AjaxController@deshjure_district')->name('deshjure_district');
Route::get('deshjure_upzilla/{id}', 'AjaxController@deshjure_upzilla')->name('deshjure_upzilla');

Route::get('news/image/{path}', 'HomeController@watermark')->name('watermark');

Route::get('lang/{locale}', function ($locale){
	if($locale == 'en'){
		Session::put('locale', $locale);
		return redirect($locale);
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

Route::get('/', 'HomeController@index')->name('home');
Route::get('en', 'HomeController@indexEn')->name('indexEn');
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
Route::get('comments/{slug}', 'CommentController@comments')->name('comments');

Route::get('repoter/profile/{username}', 'HomeController@reporterPublicProfile')->name('reporter.publicProfile');
Route::get('user/profile/{username}', 'HomeController@userPublicProfile')->name('user.publicProfile');
Route::get('{page}', 'HomeController@page')->name('page');
Route::get('reporter/request', 'UserController@request_reporter')->name('request_reporter');
Route::post('reporter/request', 'UserController@insert_request_reporter')->name('request_reporter');

Route::get('social-login/redirect/{provider}', 'SocialLoginController@redirectToProvider')->name('social.login');
Route::get('social-login/{provider}/callback', 'SocialLoginController@handleProviderCallback')->name('social.callback');
