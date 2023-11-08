<?php

use Illuminate\Support\Facades\Route;
use Pterodactyl\Http\Middleware\AdminAuthenticate;

Route::group(['namespace' => 'Pterodactyl\Http\Controllers\Admin'], function () {
    Route::get('/switch-mode', 'Unix\UnixController@SwitchMode')->name('unix.mode')->withoutMiddleware(AdminAuthenticate::class);
});

/*
|--------------------------------------------------------------------------
| Unix Controller Routes
|--------------------------------------------------------------------------
|
| Endpoint: /admin/unix
|
*/

Route::group(['namespace' => 'Pterodactyl\Http\Controllers\Admin', 'prefix' => '/admin/unix'], function () {
    Route::get('/', 'Unix\UnixController@index')->name('admin.unix');
    Route::get('/unix/index', 'Unix\UnixController@index')->name('admin.unix.index');
    Route::get('/updates', 'Unix\UnixController@updates')->name('admin.unix.update');
    Route::get('/support', 'Unix\UnixController@support')->name('admin.unix.support');
    Route::get('/alerts', 'Unix\UnixController@alerts')->name('admin.unix.alerts');
    Route::get('/login-page', 'Unix\UnixController@login_page')->name('admin.unix.login');
    Route::get('/meta', 'Unix\UnixController@meta')->name('admin.unix.meta');
    Route::get('/advanced', 'Unix\UnixController@advanced')->name('admin.unix.advanced');
    Route::get('/connectivity', 'Unix\UnixController@connectivity')->name('admin.unix.connect');
    Route::get('/background', 'Unix\UnixController@background')->name('admin.unix.background');
    Route::post('/setting', 'Unix\UnixSettingController@settingSubmit')->name('admin.unix.setting');
    Route::get('/mail', 'Unix\UnixController@email')->name('admin.mail');
    Route::post('/mail/send', 'Unix\UnixController@send')->name('admin.mail.send');
});