<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    Route::group(['prefix' => 'about',  'as' => 'about.'], function (Router $router) {

        $router->resource('jobs', 'JobController');
        $router->resource('companies', 'CompanyController');
        $router->resource('joins', 'JoinController');
        $router->resource('articles', 'ArticleController');
        $router->resource('contacts', 'ContactController');

    });

});

