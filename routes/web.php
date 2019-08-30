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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',function($api){
    $api->group(['prefix'=>'oauth'],function($api){
        $api->post('token','\Laravel\Passport\Http\Controllers\AccessTokenController');   
    });

    $api->group(['namespace'=>'App\Api\Controllers','middleware'=>['auth:api','cors']],function($api){
        //UserController.
        $api->get('users', 'UserController@index');
        $api->post('user/create', 'UserController@store');
        $api->get('user', 'UserController@show');
        $api->post('user/update', 'UserController@update');
        $api->delete('user/delete', 'UserController@destroy');
        $api->post('user/search/by', 'UserController@search');
    });
});

