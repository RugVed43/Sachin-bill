<?php

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

Route::group(['middleware' => ['cors', 'multiauth:api'], 'prefix' => 'user'], function () {
    Route::post('/logout', [
        'uses' => 'Api\Auth\ApiUserAuthentication@logout',
        'as' => 'logout',
    ]);
    Route::get('user/table', [
        'uses' => 'Api\User\ApiUserController@getDataTables',
        'as' => 'apiuser.gettbl',
    ]);
    Route::post('user/table', [
        'uses' => 'Api\User\ApiUserController@postDataTables',
        'as' => 'apiuser.posttbl',
    ]);
    Route::resource('apiuser', 'Api\User\ApiUserController');
    //CLIENT_API_ROUTES

});
Route::group(['middleware' => ['cors', 'multiauth:apiadmin'], 'prefix' => 'admin'], function () {
    Route::post('/logout', [
        'uses' => 'Api\Auth\ApiAdminAuthentication@logout',
        'as' => 'logout',
    ]);
    Route::resource('mapiadmin', 'Api\Admin\ApiAdminController');
    //ADMIN_API_ROUTES

});
Route::group(['middleware' => ['cors', 'multiauth:apiagent'], 'prefix' => 'agent'], function () {
    Route::post('/logout', [
        'uses' => 'Api\Auth\ApiAdminAuthentication@logout',
        'as' => 'logout',
    ]);
    Route::resource('aapiagent', 'Api\Agent\ApiAgentController');
    //AGENT_API_ROUTES

});

Route::group(['middleware' => 'cors'], function () {
    Route::resource('fileman', 'FileManagerController');
    Route::group(['prefix' => 'auth'], function () {
        Route::resource('user', 'Api\Auth\ApiUserAuthentication');
        Route::resource('admin', 'Api\Auth\ApiAdminAuthentication');
        Route::resource('agent', 'Api\Auth\ApiAgentAuthentication');
    });
    //API_ROUTES
});

/*
OAUTH TOKENS
URL: /oauth/token
HEADER
Accept : application/json, text/plain
Content-Type : application/json
REQ BODY :TYPE-> JSON {
"username":"admin",
"password":"123456",
"grant_type" : "client_credentials",
"client_id": "7",
"client_secret" : "erYLNmFrLwKdhznROkv4iVif0KKcfjyi3fzmn9Aj",
"provider" : "admins",
"scope":""
}

 */
