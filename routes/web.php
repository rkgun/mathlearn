<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/course/{slug}', [CourseController::class, 'index']);

Route::get('/topic/{slug}', [TopicController::class, 'index']);
Route::get('/topic/{slug}/questions', [TopicController::class, 'questions']);

Route::prefix('admin')->group(function () {
    Route::get('/coursetopic/{id}', [TopicController::class, 'courseWithTopic']);
    Route::get('/login','Auth\AdminAuthController@getLogin')->name('adminLogin');
    Route::post('/login', 'Auth\AdminAuthController@postLogin')->name('adminLoginPost');
    Route::get('/logout', 'Auth\AdminAuthController@logout')->name('adminLogout');
    
    Route::get('/forget','Auth\ForgotPasswordController@getform')->name('pass.forget_get');
    Route::post('/forget', 'Auth\ForgotPasswordController@submitform')->name('pass.forget_post'); 
    Route::get('/reset/{token}','Auth\ForgotPasswordController@getreset')
    ->name('pass.reset_get');
    Route::post('/reset','Auth\ForgotPasswordController@submitreset')->name('pass.reset_post');
});

Route::group(['middleware' => 'adminauth'], function () {
	// Admin Dashboard
	Route::get('dashboard','AdminController@dashboard')->name('dashboard');	
    //Route::get('profile/{slug}','AdminController@profile')->name('profile');	

    Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');

    Route::name('course.')->prefix('courses')->group(function () {
        //derslerin listesi görünüm
        Route::get('/','CourseController@list')->name('list');
        //ders ekle
        Route::post('/create','CourseController@store')->name('store');
        //dersi göster görünüm
        Route::get('/{id}','CourseController@read')->name('view');
        //dersi güncelle
        Route::put('/{id}/update','CourseController@update')->name('update');
        //dersi sil
        Route::get('/delete/{id}','CourseController@delete')->name('delete');
    });

    Route::name('contact.')->prefix('contacts')->group(function () {
        //iletişimlerin listesi görünüm
        Route::get('/','ContactController@list')->name('list');
        //iletişimi göster görünüm
        Route::get('/{id}','ContactController@view')->name('read');
        //iletişimi sil
        Route::delete('/delete/{id}','ContactController@answered')->name('answered');
    });

    Route::name('page.')->prefix('pages')->group(function () {
        //sayfaların listesi görünüm
        Route::get('/','PageController@list')->name('list');
        //sayfa ekle görünüm
        Route::get('/create','PageController@create')->name('create');
        //sayfa ekle post
        Route::post('/store','PageController@store')->name('store');
        //sayfa sil
        Route::delete('/delete/{id}','PageController@delete')->name('delete');
        //sayfa güncelle
        Route::put('/update/{id}','PageController@update')->name('update');
        //sayfa göster görünüm
        Route::get('/{id}','PageController@read')->name('view');
    });

    Route::name('topic.')->prefix('topics')->group(function () {
        Route::get('/','TopicController@list')->name('list');
        //konu ekle görünüm
        Route::get('/create','TopicController@create')->name('create');
        //konu ekle post
        Route::post('/store','TopicController@store')->name('store');
        //konu sil
        Route::delete('/delete/{id}','TopicController@delete')->name('delete');
        //konu göster görünüm
        Route::get('/view/{id}','TopicController@view')->name('read');
        //konu güncelle
        Route::put('/update/{id}','TopicController@update')->name('update');
    });

    Route::name('setting.')->prefix('settings')->group(function(){
        Route::get('/','SettingsController@list')->name('list');
        Route::get('/create','SettingsController@create')->name('create');
        Route::post('/store','SettingsController@store')->name('store');
        Route::delete('/delete/{id}','SettingsController@delete')->name('delete');
        Route::get('/view/{id}','SettingsController@view')->name('read');
        Route::put('/update/{id}','SettingsController@update')->name('update');
        Route::put('/update/icon-logo','SettingsController@update')->name('icon_logo');
        Route::get('sitemap','SettingsController@sitemap')->name('sitemap');
    });
});

Route::get('/{slug?}', [PageController::class, 'view']);