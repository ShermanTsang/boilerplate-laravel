<?php

use Dcat\Admin\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // Api Routes
    $router->get('/api/option/user', 'ApiController@getUserOptions')->name('api.option.user');
    $router->get('/api/option/postCategory', 'ApiController@getPostCategoryOptions')->name('api.option.postCategory');

    // Resource Routes
    $router->resource('/advertise', 'AdvertiseController');
    $router->resource('/banner', 'BannerController');
    $router->resource('/administrator', 'AdministratorController');
    $router->resource('/post', 'PostController');
    $router->resource('/postCategory', 'PostCategoryController');
    $router->resource('/page', 'PageController');
    $router->resource('/setting', 'SettingController');
    $router->resource('/user', 'UserController');
    $router->resource('/wechatConnector', 'WechatConnectorController');
    $router->resource('/notify', 'NotifyController');


});
