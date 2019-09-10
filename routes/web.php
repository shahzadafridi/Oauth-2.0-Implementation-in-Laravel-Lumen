<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::get('/', function () {
    // return view('pages.home');
});


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'oauth'], function ($api) {
        // $api->post('token','App\Api\Controllers\UserController@getToken');   
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['auth:api', 'cors']], function ($api) {
        //UserController.
        $api->get('users', 'UserController@index');
        $api->get('user', 'UserController@show');
        $api->post('user/update', 'UserController@update');
        $api->post('user/delete', 'UserController@destroy');
        $api->post('user/search/by', 'UserController@search');
    });
    $api->post('user/login', 'App\Api\Controllers\UserController@login');
    $api->post('user/create', 'App\Api\Controllers\UserController@store');
    $api->post('token', 'App\Api\Controllers\UserController@getToken');

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['checkToken']], function ($api) {
        $api->post('refreshToken', 'UserController@getRefreshToken');
    });

    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['auth:api', 'cors']], function ($api) {
        //UserController.
        $api->get('backend/users', 'ApiController@index');
        $api->get('backend/user', 'ApiController@show');
        $api->post('backend/user/update', 'ApiController@update');
        $api->post('backend/user/delete', 'ApiController@destroy');
        $api->post('backend/user/search/by', 'ApiController@search');
        $api->post('backend/user/login', 'ApiController@login');
        $api->post('backend/user/create', 'ApiController@store');
        $api->post('backend/refreshToken', 'ApiController@getRefreshToken');
    });

    $api->post('backend/token', 'App\Api\Controllers\ApiController@getToken');

});

Route::get('home', 'PagesController@home');
