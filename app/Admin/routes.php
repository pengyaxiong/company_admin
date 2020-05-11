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

        //广告管理
        $router->resource('ads', 'AdsController');

    });

    //海外试管
    Route::group(['prefix' => 'out', 'namespace' => 'Out', 'as' => 'out.'], function (Router $router) {
        //名医荟萃
        $router->resource('doctors', 'DoctorController');
        //成功案例
        $router->resource('works', 'WorkController');
        $router->resource('work-categories', 'WorkCategoryController');
        //海外医院
        $router->resource('hospitals', 'HospitalController');
        //试管套餐
        $router->resource('articles', 'ArticleController');
    });

    //
    Route::group(['prefix' => 'other', 'namespace' => 'Other', 'as' => 'other.'], function (Router $router) {
        //生殖机构大全
        $router->resource('organizations', 'OrganizationController');

        //轮播图
        $router->resource('banners', 'BannerController');
        //专业领域
        $router->resource('fields', 'FieldController');
        //服务优势
        $router->resource('services', 'ServiceController');
        //文章分类
        $router->resource('article-categories', 'ArticleCategoryController');
        //文章列表
        $router->resource('articles', 'ArticleController');

    });
});

