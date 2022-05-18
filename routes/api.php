<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::group([
    'middleware' => 'api',
], function () {
    // data master 
    Route::get('/master/list-satker', 'Api\Master\SatkerController@getDataMaster');
    Route::get('/master/penyidik', 'Api\Master\PenyidikController@getDataMaster');

    Route::post('/send-message-whatsapp','Api\Master\SendWhatsappController@sendMessage');

    Route::post('/check_version', 'Api\VersionController@v1');
    
    Route::post('/login', 'Api\AuthController@login');
    Route::post('/refresh', 'Api\AuthController@refresh');
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::prefix('notification')->group(function () {
            Route::get('/', 'Api\NotificationController@getNotification');
            Route::post('/count', 'Api\NotificationController@countNotif');
            Route::post('/read-notification', 'Api\NotificationController@readNotification');
        });

        Route::prefix('dashboard')->group(function() {
            Route::get('/', 'API\DashboardController@dataDashboard');
        });

        Route::get('/kepolisian/list-perkara', 'Api\KepolisianController@listPerkara');
        Route::get('/kepolisian/dashboard', 'Api\KepolisianController@dashboard');

        Route::get('/chat', 'Api\ChatController@getListChatToMe');
        Route::get('/contacts', 'Api\ChatController@getContact');

        Route::post('/valid-token', 'Api\AuthController@validToken');

        Route::post('/logout', 'Api\AuthController@logout');
    });
});
