<?php

use Illuminate\Support\Facades\Route;

route::group(['middleware' => ['auth']], function(){

});

//profile image change for all user
Route::post('change/profile/image', 'AjaxController@changeProfileImage')->name('changeProfileImage');

//get product subcategory by category ID
Route::get('get/subcategory/{cat_id}', 'AjaxController@get_subcategory')->name('getSubCategory');
//get product sub child category by sub category ID
Route::get('get/subchild/category/{subcat_id}', 'AjaxController@get_subchild_category')->name('getSubChildCategory');

Route::get('get/attribute/{cat_id}', 'AjaxController@getAttributeByCategory')->name('getAttributeByCategory');

//delete data common all table
Route::get('/delete/data/common', 'AjaxController@deleteDataCommon')->name('deleteDataCommon');

//get search keyword in header
Route::get('search/keyword', 'AjaxController@search_keyword')->name('search_keyword');

//change status active/deactive
Route::get('status/change', 'AjaxController@satusActiveDeactive')->name('statusChange');
Route::get('status/approve/Unapprove', 'AjaxController@approveUnapprove')->name('approveUnapprove');

Route::get('currency/change', 'CurrencyController@changeCurrency')->name('changeCurrency');

//position sorting
Route::get('position/sorting', 'AjaxController@positionSorting')->name('positionSorting');

Route::get('news-slug/create/{slug?}', 'AjaxController@createUniqueSlug')->name('news.slug');

Route::get('get/state/{country_id?}', 'AjaxController@get_state')->name('get_state');
Route::get('get/city/{state_id?}', 'AjaxController@get_city')->name('get_city');
Route::get('get/area/{city_id?}', 'AjaxController@get_area')->name('get_area');