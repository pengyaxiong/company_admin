<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    //关于我们
    Route::group(['prefix' => 'about', 'namespace' => 'About', 'as' => 'about.'], function (Router $router) {

        $router->resource('jobs', 'JobController');
        $router->resource('companies', 'CompanyController');
        $router->resource('joins', 'JoinController');
        $router->resource('articles', 'ArticleController');
        $router->resource('contacts', 'ContactController');

    });

    //助孕小课堂
    Route::group(['prefix' => 'cms', 'namespace' => 'Cms', 'as' => 'cms.'], function (Router $router) {
        //今日资讯
        $router->resource('informations', 'InformationController');
        //试管专题栏目
        $router->resource('article-categories', 'ArticleCategoryController');
        //试管专题文章
        $router->resource('articles', 'ArticleController');
        //知识百科栏目
        $router->resource('know-categories', 'KnowCategoryController');
        //知识百科文章
        $router->resource('knows', 'KnowController');

    });
});

