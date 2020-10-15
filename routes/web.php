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

Route::get('/', [
    'uses' => 'AdminAuth\AdminAuthController@showLoginForm',
    'as' => 'landing',
]);
Route::get('/laralog_view', [
    'uses' => 'User\HomeController@laraLogView',
    'as' => 'laralog_view',
]);
Route::get('/laralog_clear', [
    'uses' => 'User\HomeController@laraLogClear',
    'as' => 'laralog_clear',
]);

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::resource('resetpass', 'PasswordResetsController');

Auth::routes();

Route::get('/home', 'User\HomeController@index')->name('home');
Route::get('/profile', [
    'uses' => 'User\HomeController@profile',
    'as' => 'user_profile',
]);
Route::post('/profile', [
    'uses' => 'User\HomeController@setProfile',
    'as' => 'user_profile',
]);
// Route::get('/pay', 'User\HomeController@pay')->name('pay');
// Route::post('/recv', 'User\HomeController@recv')->name('recv');
Route::resource('user', 'User\UserController');

//USER_ROUTES

//ADMIN
Route::group(['middleware' => 'admin_guest'], function () {
    Route::get('admin_login', 'AdminAuth\AdminAuthController@showLoginForm')->name('admin_login');
    Route::post('admin_login', 'AdminAuth\AdminAuthController@login')->name('admin_login');
});

Route::group(['middleware' => 'admin_auth', 'prefix' => 'admin'], function () {
    Route::get('/', [
        'uses' => 'Admin\AdminHomeController@index',
        'as' => 'admin_home',
    ]);
    Route::get('/profile', [
        'uses' => 'Admin\AdminHomeController@profile',
        'as' => 'admin_profile',
    ]);
    Route::post('/profile', [
        'uses' => 'Admin\AdminHomeController@setProfile',
        'as' => 'admin_profile',
    ]);
    Route::post('/logout', 'AdminAuth\AdminAuthController@logout')->name('admin_logout');
    Route::resource('mroles', 'Admin\ManageRoleController');
    Route::resource('mpermissions', 'Admin\ManagePermissionController');
    Route::resource('madmin', 'Admin\ManageAdminController');
    Route::resource('muser', 'Admin\ManageUserController');
    Route::resource('magent', 'Admin\ManageAgentController');
    //ADMIN_ROUTES

});

Route::group(['middleware' => 'agent_guest'], function () {
    // Route::get('agent_register', 'AgentAuth\RegisterController@showRegistrationForm');
    // Route::post('agent_register', 'AgentAuth\RegisterController@register');
    Route::get('agent_login', 'AgentAuth\LoginController@showLoginForm')->name('agent_login');
    Route::post('agent_login', 'AgentAuth\LoginController@login')->name('agent_login');
});

//Only logged in agents can access or send requests to these pages
Route::group(['middleware' => 'agent_auth', 'prefix' => 'agent'], function () {
    Route::get('/', [
        'uses' => 'Agent\AgentController@index',
        'as' => 'agent_home',
    ]);
    Route::post('agent_logout', 'AgentAuth\LoginController@logout')->name('agent_loout');
    Route::get('/agent_home', [
        'uses' => 'Agent\AgentController@index',
        'as' => 'agenthome',
    ]);
    //AGENT_ROUTES

});
