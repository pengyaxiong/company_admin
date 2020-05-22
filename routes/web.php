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

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/search', 'HomeController@search')->name('home.search');


//生殖机构大全
Route::get('organizations', 'HomeController@organizations')->name('home.organizations');
Route::get('organization/{id}', 'HomeController@organization')->name('home.organization');

Route::get('articles', 'HomeController@articles')->name('home.articles');
Route::get('article/{id}', 'HomeController@article')->name('home.article');

//关于我们
Route::group(['prefix' => 'about', 'as' => 'about.'], function () {

    //新闻资讯
    Route::get('articles', 'AboutController@articles')->name('articles');
    Route::get('article/{id}', 'AboutController@article')->name('article');

    //公司简介
    Route::get('company', 'AboutController@company')->name('company');
    //加盟代理
    Route::get('join', 'AboutController@join')->name('join');
    Route::post('join_us', 'AboutController@join_us')->name('join_us');
    //人才招聘
    Route::get('job', 'AboutController@job')->name('job');
    //联系我们
    Route::get('content', 'AboutController@content')->name('content');

});


//助孕小课堂
Route::group(['prefix' => 'cms', 'as' => 'cms.'], function () {

    //试管专题栏目
    Route::get('article-categories', 'CmsController@article_categories')->name('article_categories');
    //试管专题文章
    Route::get('today-articles', 'CmsController@today_articles')->name('today_articles');
    Route::get('articles', 'CmsController@articles')->name('articles');
    //试管专题文章详情
    Route::get('article/{id}', 'CmsController@article')->name('article');

    //知识百科文章
    Route::get('knows', 'CmsController@knows')->name('knows');
    //知识百科文章详情
    Route::get('know/{id}', 'CmsController@know')->name('know');

});

//海外试管
Route::group(['prefix' => 'out', 'as' => 'out.'], function () {
    //名医荟萃
    Route::get('doctors', 'OutController@doctors')->name('doctors');
    //名医荟萃详情
    Route::get('doctor/{id}', 'OutController@doctor')->name('doctor');

    //成功案例
    Route::get('works/{id}', 'OutController@works')->name('works');
    //成功案例详情
    Route::get('work/{id}', 'OutController@work')->name('work');

    //海外医院
    Route::get('hospitals', 'OutController@hospitals')->name('hospitals');
    //海外医院详情
    Route::get('hospital/{id}', 'OutController@hospital')->name('hospital');

    //试管套餐
    Route::get('articles', 'OutController@articles')->name('articles');
    //试管套餐详情
    Route::get('article/{id}', 'OutController@article')->name('article');
});