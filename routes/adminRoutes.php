<?php

use Illuminate\Support\Facades\Route;

Route::get('kalamadmin', 'UserAdminController@login')->name('admin');
Route::get('/login', 'Backend\AdminLoginController@LoginForm')->name('adminLoginForm');
Route::post('/login', 'Backend\AdminLoginController@login')->name('adminLogin');
Route::get('/register', 'Backend\AdminLoginController@RegisterForm')->name('adminRegisterForm');
Route::post('/register', 'Backend\AdminLoginController@register')->name('adminRegister');
Route::post('/logout', 'Backend\AdminLoginController@logout')->name('adminLogout');

route::get('message/{username?}', 'MessageController@message')->name('messageAdmin');

Route::group(['middleware' => 'auth:admin', 'namespace' => 'Backend'], function(){

	Route::get('/', 'DashboardController@dashboard')->name('admin.dashboard');

	//setting
	Route::get('general/setting', 'GeneralSettingController@generalSetting')->name('generalSetting');
	Route::post('general/setting/update/{id}', 'GeneralSettingController@generalSettingUpdate')->name('generalSettingUpdate');

	Route::get('logo/setting', 'GeneralSettingController@logoSetting')->name('logoSetting');
	Route::post('logo/setting/update/{id}', 'GeneralSettingController@logoSettingUpdate')->name('logoSettingUpdate');
	Route::match(['get', 'post'], 'google/setting', 'GeneralSettingController@googleSetting')->name('googleSetting');
	Route::match(['get', 'post'], 'google/recaptcha', 'SiteSettingController@google_recaptcha')->name('google_recaptcha');
	Route::match(['get', 'post'], 'seo/setting', 'GeneralSettingController@seoSetting')->name('seoSetting');
	Route::post('sitemap/setting','SitemapController@sitemapSetting')->name('sitemapSetting');

	Route::get('header/setting', 'GeneralSettingController@headerSetting')->name('headerSetting');
	Route::post('header/setting/update/{id}', 'GeneralSettingController@headerSettingUpdate')->name('headerSettingUpdate');
	Route::get('footer/setting', 'GeneralSettingController@footerSetting')->name('footerSetting');
	Route::post('footer/setting/update/{id}', 'GeneralSettingController@footerSettingUpdate')->name('footerSettingUpdate');

	Route::get('profile/update', 'AdminController@profileEdit')->name('admin.profileUpdate');
	Route::post('profile/update', 'AdminController@profileUpdate')->name('admin.profileUpdate');

	Route::get('change/password', 'AdminController@passwordChange')->name('admin.passwordChange');
	Route::post('change/password', 'AdminController@passwordUpdate')->name('admin.passwordChange');

	Route::get('social/login/setting', 'SocialController@socialLoginSetting')->name('socialLoginSetting');
	Route::post('social/login/setting/update', 'SocialController@socialLoginSettingUpdate')->name('socialLoginSettingUpdate');

	Route::get('social/setting', 'SocialController@socialSetting')->name('socialSetting');
	Route::post('social/setting/store', 'SocialController@socialSettingStore')->name('socialSettingStore');
	Route::get('social/setting/edit/{id}', 'SocialController@socialSettingEdit')->name('socialSettingEdit');
	Route::post('social/setting/update/{id}', 'SocialController@socialSettingUpdate')->name('socialSettingUpdate');
	Route::get('social/setting/delete/{id}', 'SocialController@socialSettingDelete')->name('socialSettingDelete');

	// site setting

	Route::get('site/setting', 'SiteSettingController@siteSettings')->name('site_settings');
	Route::get('smtp/configurations', 'SiteSettingController@smtp_settings')->name('smtp_settings');
	Route::match(['get', 'post'], 'otp/configurations', 'SiteSettingController@otp_configurations')->name('otp_configurations');
	Route::post('env_key_update', 'SiteSettingController@env_key_update')->name('env_key_update');

	Route::get('site/setting/update/status', 'SiteSettingController@siteSettingActiveDeactive')->name('siteSettingActiveDeactive');
	Route::match(['get', 'post'], 'site/setting/update', 'SiteSettingController@siteSettingUpdate')->name('siteSettingUpdate');

	//category
	Route::get('category', 'CategoryController@index')->name('category.list');
	Route::get('category/create', 'CategoryController@create')->name('category.create');
	Route::post('category/store', 'CategoryController@store')->name('category.store');
	Route::get('category/show/{id}', 'CategoryController@show')->name('category.show');
	Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.edit');
	Route::post('category/update', 'CategoryController@update')->name('category.update');
	Route::get('category/delete/{id}', 'CategoryController@delete')->name('category.delete');

	Route::get('subcategory', 'SubCategoryController@index')->name('subcategory.list');
	Route::get('subcategory/create', 'SubCategoryController@create')->name('subcategory.create');
	Route::post('subcategory/store', 'SubCategoryController@store')->name('subcategory.store');
	Route::get('subcategory/show/{id}', 'SubCategoryController@show')->name('subcategory.show');
	Route::get('subcategory/edit/{id}', 'SubCategoryController@edit')->name('subcategory.edit');
	Route::post('subcategory/update', 'SubCategoryController@update')->name('subcategory.update');
	Route::get('subcategory/delete/{id}', 'SubCategoryController@delete')->name('subcategory.delete');

	Route::prefix('division')->name('division.')->group( function() {
        Route::get('/', 'DeshjureController@division')->name('index');
        Route::post('store', 'DeshjureController@division_store')->name('store');
        Route::get('edit/{id}', 'DeshjureController@division_edit')->name('edit');
        Route::post('update', 'DeshjureController@division_update')->name('update');
        Route::get('delete/{id}', 'DeshjureController@division_delete')->name('delete');
    });
    Route::prefix('district')->name('district.')->group( function() {
        Route::get('/', 'DeshjureController@district')->name('index');
        Route::post('store', 'DeshjureController@district_store')->name('store');
        Route::get('edit/{id}', 'DeshjureController@district_edit')->name('edit');
        Route::post('update', 'DeshjureController@district_update')->name('update');
        Route::get('delete/{id}', 'DeshjureController@district_delete')->name('delete');
    });
    Route::prefix('upzilla')->name('upzilla.')->group( function() {
        Route::get('/', 'DeshjureController@upzilla')->name('index');
        Route::post('store', 'DeshjureController@upzilla_store')->name('store');
        Route::get('edit/{id}', 'DeshjureController@upzilla_edit')->name('edit');
        Route::post('update', 'DeshjureController@upzilla_update')->name('update');
        Route::get('delete/{id}', 'DeshjureController@upzilla_delete')->name('delete');
	});

	Route::get('speciality', 'SpecialityController@index')->name('speciality.list');
	Route::get('speciality/create', 'SpecialityController@create')->name('speciality.create');
	Route::post('speciality/store', 'SpecialityController@store')->name('speciality.store');
	Route::get('speciality/show/{id}', 'SpecialityController@show')->name('speciality.show');
	Route::get('speciality/edit/{id}', 'SpecialityController@edit')->name('speciality.edit');
	Route::post('speciality/update', 'SpecialityController@update')->name('speciality.update');
	Route::get('speciality/delete/{id}', 'SpecialityController@delete')->name('speciality.delete');

		// homepage routes
	Route::get('homepage/section', 'HomepageSectionController@index')->name('admin.homepageSection');
	Route::post('homepage/section/store', 'HomepageSectionController@store')->name('admin.homepageSection.store');
	Route::get('homepage/section/edit/{id}', 'HomepageSectionController@edit')->name('admin.homepageSection.edit');
	Route::post('homepage/section/update', 'HomepageSectionController@update')->name('admin.homepageSection.update');
	Route::get('homepage/section/delete/{id}', 'HomepageSectionController@delete')->name('admin.homepageSection.delete');
	Route::get('homepage/section/sorting', 'HomepageSectionController@homepageSectionSorting')->name('admin.homepageSectionSorting');


	// homepage section routes
	Route::get('homepage/section/item/{slug?}', 'HomepageSectionItemController@index')->name('admin.homepageSectionItem');
	Route::post('homepage/section/item/store', 'HomepageSectionItemController@store')->name('admin.homepageSectionItem.store');
	Route::get('homepage/section/item/edit/{id}', 'HomepageSectionItemController@edit')->name('admin.homepageSectionItem.edit');
	Route::post('homepage/section/item/update', 'HomepageSectionItemController@update')->name('admin.homepageSectionItem.update');
	Route::get('homepage/section/item/remove/{id}', 'HomepageSectionItemController@itemRemove')->name('admin.homepageSectionItem.remove');

	//get course ajax request
	Route::get('section/get/all/course', 'HomepageSectionItemController@getAllItems')->name('section.getAllItems');
	Route::get('section/get/all/categories', 'HomepageSectionItemController@getAllcategories')->name('section.getAllcategories');
	Route::get('section/get/all/banners', 'HomepageSectionItemController@getAllBanners')->name('section.getAllBanners');

	Route::get('section/single/item/store', 'HomepageSectionItemController@sectionSingleItemStore')->name('admin.sectionSingleItemStore');
	Route::post('section/item/store', 'HomepageSectionItemController@sectionMultiItemStore')->name('admin.sectionMultiItemStore');


 	//Bangla News Route
    Route::get('news/create', 'NewsController@create')->name('news.create');
    Route::get('news/edit/{news_slug}', 'NewsController@edit')->name('news.edit');
   	Route::get('news/list/{status?}', 'NewsController@index')->name('news.list');

    //English News Route
    Route::get('english/news/create', 'EnglishNewsController@create')->name('englishNews.create');
    Route::get('english/news/edit/{news_slug}', 'EnglishNewsController@edit')->name('englishNews.edit');
    Route::get('english/news/{status?}', 'EnglishNewsController@index')->name('englishNews.list');
 

   	//store, update, delete route same both news
   	Route::post('news/store', 'NewsController@store')->name('news.store');
    Route::post('news/update/{id}', 'NewsController@update')->name('news.update');
    Route::get('news/delete/{id}', 'NewsController@delete')->name('news.delete');
    Route::get('news/attachFile/delete/{id}', 'NewsController@deleteAttachFile')->name('deleteAttachFile');

    Route::get('news/selectImage', 'NewsController@selectImage')->name('selectImage');

    Route::get('news/approval/{id}', 'NewsController@newApproveUnapprove')->name('newApproveUnapprove');
    Route::get('breaking_news/{status}', 'NewsController@breaking_news')->name('breaking_news');

    	// payment route
	Route::get('payment/gateway', 'PaymentGatewayController@index')->name('paymentGateway');
	Route::post('payment/gateway/store', 'PaymentGatewayController@store')->name('paymentGateway.store');
	Route::get('payment/gateway/edit/{id}', 'PaymentGatewayController@edit')->name('paymentGateway.edit');
	Route::post('payment/gateway/update', 'PaymentGatewayController@update')->name('paymentGateway.update');
	Route::get('payment/gateway/delete/{id}', 'PaymentGatewayController@delete')->name('paymentGateway.delete');

    //withdraw request list
    Route::get('wallet/withdraw/configuration', 'WithdrawController@userWithdrawConfigure')->name('withdrawConfigure');
	Route::get('wallet/withdraw/request', 'WithdrawController@withdrawRequest')->name('withdrawRequest');
	Route::get('get/withdraw/history/{user_id}', 'WithdrawController@getWithdrawHistory')->name('getWithdrawHistory');
	Route::get('withdraw/request/update', 'WithdrawController@changeWithdrawStatus')->name('changeWithdrawStatus');
	Route::get('transactions', 'WithdrawController@wallet_transactions')->name('admin.transactions');

	Route::post('wallet/recharge', 'WithdrawController@walletRecharge')->name('walletRecharge');
	Route::get('get/wallet/information', 'WithdrawController@getWalletInfo')->name('getWalletInfo');
    //not use now
    // Route::post('news/image_upload', 'NewsController@image_upload')->name('image_upload');

	Route::prefix('photo')->name('photo.')->group( function(){
	    Route::get('gallery', 'MediaGalleryController@photo_list')->name('gallery');
	    Route::get('create', 'MediaGalleryController@photo_create')->name('create');
	    Route::post('upload', 'MediaGalleryController@photo_upload')->name('upload');
	    Route::get('edit/{id}', 'MediaGalleryController@photo_edit')->name('edit');
	    Route::post('update', 'MediaGalleryController@photo_update')->name('update');
	    Route::get('delete/{id}', 'MediaGalleryController@photo_delete')->name('delete');

	    Route::post('upload/CKEditor', 'MediaGalleryController@photo_uploadCKEditor')->name('photo_uploadCKEditor');
	});

	Route::prefix('video')->name('video.')->group( function(){
	    Route::get('gallery', 'MediaGalleryController@video_list')->name('gallery');
	    Route::get('create', 'MediaGalleryController@video_create')->name('create');
	    Route::post('upload', 'MediaGalleryController@video_upload')->name('upload');
	    Route::get('edit/{id}', 'MediaGalleryController@video_edit')->name('edit');
	    Route::post('update', 'MediaGalleryController@video_update')->name('update');
	    Route::get('delete/{id}', 'MediaGalleryController@video_delete')->name('delete');
	});

	Route::prefix('reporter')->name('reporter.')->group( function(){
	    Route::get('list/{status?}', 'ReporterController@index')->name('list');
	    Route::get('create', 'ReporterController@create')->name('create');
	    Route::post('store', 'ReporterController@store')->name('store');
	    Route::get('edit/{id}', 'ReporterController@edit')->name('edit');
	    Route::post('update/{id}', 'ReporterController@update')->name('update');
	    Route::get('delete/{id}', 'ReporterController@delete')->name('delete');
	    Route::get('status/{id}', 'ReporterController@reporterStatus')->name('status');
	    Route::get('reporter/secret/login/{id}', 'ReporterController@reporterSecretLogin')->name('secretLogin');
	    Route::get('profile/{slug}', 'ReporterController@reporterProfile')->name('profile');
	});

	Route::prefix('reporter-request')->name('reporterRequest.')->group( function(){
	    Route::get('list', 'ReporterController@manage_request')->name('list');
	    Route::get('rejected/List', 'ReporterController@rejectedList')->name('rejectedList');
	    Route::get('AcceptReject/{status}', 'ReporterController@statusAcceptReject')->name('status');
	  
	});

	Route::prefix('user')->name('admin.')->group( function() {
		Route::post('store', 'UserAdminController@store')->name('user.store');
		Route::get('edit/{id}', 'UserAdminController@edit')->name('user.edit');
		Route::post('update', 'UserAdminController@update')->name('user.update');
		Route::get('delete/{id}', 'UserAdminController@delete')->name('user.delete');

		Route::get('list/{status?}', 'UserAdminController@userList')->name('user.list');
		Route::get('secret/login/{id}', 'UserAdminController@userSecretLogin')->name('userSecretLogin');
		Route::get('profile/{username}', 'UserAdminController@userProfile')->name('userProfile');
	});


	Route::prefix('page')->name('page.')->group( function(){
		Route::get('list', 'PageController@list')->name('list');
		Route::get('create', 'PageController@create')->name('create');
		Route::post('store', 'PageController@store')->name('store');
		Route::get('edit/{slug}', 'PageController@edit')->name('edit');
		Route::post('update', 'PageController@update')->name('update');
		Route::get('delete/{id}', 'PageController@delete')->name('delete');
	});

	Route::prefix('poll')->name('admin.poll.')->group( function(){
		Route::get('list', 'PollController@list')->name('list');
		Route::post('store', 'PollController@store')->name('store');
		Route::get('edit/{slug}', 'PollController@edit')->name('edit');
		Route::post('update', 'PollController@update')->name('update');
		Route::get('delete/{id}', 'PollController@delete')->name('delete');

		Route::get('option/delete/{id}', 'PollController@pollOptionDelete')->name('option.delete');
		Route::get('result/{poll_id}', 'PollController@pollResult')->name('result');
	});

	Route::prefix('advertisement')->name('addvertisement.')->group( function(){
        Route::get('list', 'AddvertisementController@index')->name('list');
		Route::get('create', 'AddvertisementController@create')->name('create');
		Route::post('store', 'AddvertisementController@store')->name('store');
		Route::get('edit/{id}', 'AddvertisementController@edit')->name('edit');
		Route::post('update', 'AddvertisementController@update')->name('update');
		Route::get('delete/{id}', 'AddvertisementController@delete')->name('delete');
	});

    Route::prefix('setting')->name('setting.')->group( function() {
        Route::get('/', 'SettingController@index')->name('index');
        Route::post('store', 'SettingController@setting_store')->name('store');
        Route::get('edit/{id}', 'SettingController@setting_edit')->name('edit');
        Route::post('update', 'SettingController@setting_update')->name('update');
        Route::get('delete/{id}', 'SettingController@setting_delete')->name('delete');
    });



    Route::get('comment/list', 'CommentController@allComments')->name('allComments');
	Route::post('comment/update', 'CommentController@commentUpdate')->name('commentUpdate');

});


