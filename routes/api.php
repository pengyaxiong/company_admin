<?php

use Illuminate\Http\Request;

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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//关于我们
Route::group(['prefix' => 'about', 'namespace' => 'Api', 'as' => 'about.'], function () {

    //新闻资讯
    Route::get('articles', 'AboutController@articles');
    Route::get('article/{id}', 'AboutController@article');
    //公司简介
    Route::get('company', 'AboutController@company');
    //加盟代理
    Route::post('join', 'AboutController@join');
    //人才招聘
    Route::get('job', 'AboutController@job');
    //联系我们
    Route::get('content', 'AboutController@content');

});

//助孕小课堂
Route::group(['prefix' => 'cms', 'namespace' => 'Api', 'as' => 'cms.'], function () {

    //今日资讯
    Route::get('informations', 'CmsController@informations');
    //今日资讯详情
    Route::get('information/{id}', 'CmsController@information');

    //试管专题栏目
    Route::get('article-categories', 'CmsController@article_categories');
    //试管专题文章
    Route::get('articles', 'CmsController@articles');
    //试管专题文章详情
    Route::get('article/{id}', 'CmsController@article');

    //知识百科栏目
    Route::get('know-categories', 'CmsController@know_categories');
    //知识百科文章
    Route::get('knows', 'CmsController@knows');
    //知识百科文章详情
    Route::get('know/{id}', 'CmsController@know');
});


//海外试管
Route::group(['prefix' => 'out', 'namespace' => 'Api', 'as' => 'out.'], function () {
    //名医荟萃
    Route::get('doctors', 'OutController@doctors');
    //名医荟萃详情
    Route::get('doctor/{id}', 'OutController@doctor');

    //成功案例栏目
    Route::get('work-categories', 'OutController@work_categories');
    //成功案例
    Route::get('works', 'OutController@works');
    //成功案例详情
    Route::get('work/{id}', 'OutController@work');

    //海外医院
    Route::get('hospitals', 'OutController@hospitals');
    //海外医院详情
    Route::get('hospital/{id}', 'OutController@hospital');

    //试管套餐
    Route::get('articles', 'OutController@articles');
    //试管套餐详情
    Route::get('article/{id}', 'OutController@article');
});

//首页
Route::group(['prefix' => 'other', 'namespace' => 'Api', 'as' => 'other.'], function () {
    //生殖机构大全
    Route::get('organizations', 'OtherController@organizations');

    Route::get('organization/{id}', 'OtherController@organization');
    //轮播图
    Route::get('banners', 'OtherController@banners');
    //专业领域
    Route::get('fields', 'OtherController@fields');
    //服务优势
    Route::get('services', 'OtherController@services');
    //文章分类
    Route::get('article-categories', 'OtherController@article_categories');
    //文章列表
    Route::get('articles', 'OtherController@articles');
    //文章详情
    Route::get('article/{id}', 'OtherController@article');
});

//公共方法
Route::group(['prefix' => 'common', 'namespace' => 'Api', 'as' => 'common.'], function () {

    //全局搜索
    Route::post('search', 'CommonController@search');
    //热门搜索
    Route::get('hot-search', 'CommonController@hot_search');

});

