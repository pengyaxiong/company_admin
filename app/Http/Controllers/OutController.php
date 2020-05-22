<?php

namespace App\Http\Controllers;

use App\Admin\Models\About\Company;
use App\Admin\Models\Cms\Ads;
use App\Admin\Models\Out\Article;
use App\Admin\Models\Out\Doctor;
use App\Admin\Models\Out\Hospital;
use App\Admin\Models\Out\Work;
use App\Admin\Models\Out\WorkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Admin\Models\About\Contact;

class OutController extends Controller
{
    public function __construct()
    {
        //联系方式
        $contacts = Contact::first();
        $company = Company::first();
        //广告
        $ads = Ads::where('is_show', true)->where('type', true)->orderby('sort_order')->get();

        $zy_means = \App\Admin\Models\Cms\ArticleCategory::has('articles')->where('is_show', true)->orderby('sort_order', 'asc')->get();

        $search_keywords = [];
        $keys = DB::table('cache')->orderBy('num', 'desc')->limit(16)->pluck('key')->toArray();
        if (!empty($keys)) {
            foreach ($keys as $k => $key) {
                $keyword = Str::after($key, '_cache');
                $search_keywords[$k] = Cache::store('database')->get($keyword);
            }
        }

        view()->share([
            'contacts' => $contacts,
            'zy_means' => $zy_means,
            'company' => $company,
            'ads' => $ads,
            'search_keywords' => $search_keywords,
        ]);
    }

    //海外医院
    public function hospitals(Request $request)
    {
        $hospitals = Hospital::with('doctors')->where('is_show', true)->orderby('sort_order', 'asc')->paginate(env('PAGE_SIZE'));

        $page = isset($page) ? $request['page'] : 1;
        $hospitals = $hospitals->appends(array(
            'page' => $page,
        ));
        $articles = Article::where('is_show', true)->where('is_recommend', true)->orderby('sort_order', 'asc')->limit(16)->get();

        return view('home.out.hospitals', compact('hospitals', 'articles'));
    }

    //海外医院详情
    public function hospital($id)
    {
        $hospital = Hospital::with('doctors')->find($id);

        $articles = Article::where('is_show', true)->where('is_hot', true)->orderby('sort_order', 'asc')->limit(6)->get();

        return view('home.out.hospital', compact('hospital', 'articles'));
    }


    //名医荟萃
    public function doctors(Request $request)
    {
        $doctors = Doctor::with(['hospital', 'works'])->where('is_show', true)->orderby('sort_order', 'asc')->paginate(env('PAGE_SIZE'));

        $page = isset($page) ? $request['page'] : 1;
        $doctors = $doctors->appends(array(
            'page' => $page,
        ));

        $recommend_articles = Article::where('is_recommend', true)
            ->where('is_show', true)->orderby('sort_order')->limit(16)->get();

        return view('home.out.doctors', compact('doctors', 'recommend_articles'));
    }

    //名医荟萃详情
    public function doctor(Request $request, $id)
    {
        $doctor = Doctor::with(['hospital', 'works'])->find($id);

        $all_hot = Article::where('is_show', true)->where('is_hot', true)->orderby('sort_order')->limit(6)->get();

        $articles = Work::where('doctor_id', $id)->where('is_show', true)->orderby('sort_order', 'asc')->paginate(env('PAGE_SIZE'));

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
        ));

        return view('home.out.doctor', compact('doctor', 'all_hot', 'articles'));
    }


    //试管套餐
    public function articles(Request $request)
    {

        $articles = Article::where('is_show', true)->orderby('sort_order', 'asc')->paginate(env('PAGE_SIZE'));

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
        ));

        $hospitals = Hospital::where('is_recommend', true)->where('is_show', true)->orderby('sort_order', 'asc')->limit(6)->get();

        $recommend_articles = Article::where('is_recommend', true)
            ->where('is_show', true)->orderby('sort_order')->limit(6)->get();

        return view('home.out.articles', compact('articles', 'recommend_articles', 'hospitals'));
    }

    //试管套餐详情
    public function article($id)
    {
        $article = Article::find($id);

        $hospitals = Hospital::where('is_recommend', true)->where('is_show', true)->orderby('sort_order', 'asc')->limit(6)->get();

        $recommend_articles = Article::where('is_recommend', true)
            ->where('is_show', true)->orderby('sort_order')->limit(16)->get();

        $hot_articles = Article::where('is_hot', true)
            ->where('is_show', true)->orderby('sort_order')->limit(6)->get();

        $article['prev_data'] = Article::where('sort_order', '<=', $article->sort_order)->where('id', '!=', $article->id)->first();
        $article['next_data'] = Article::where('sort_order', '>=', $article->sort_order)->where('id', '!=', $article->id)->first();

        return view('home.out.article', compact('article', 'recommend_articles', 'hospitals', 'hot_articles'));
    }

    //成功案例
    public function works(Request $request, $category_id)
    {
        $categories=WorkCategory::orderby('sort_order', 'asc')->get();

        $category_id = $category_id > 0 ? $category_id : WorkCategory::orderby('sort_order', 'asc')->first()->id;

        $works = Work::with(['category', 'doctor'])->where('is_show', true)->where('category_id', $category_id)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $works = $works->appends(array(
            'page' => $page,
            'category_id' => $category_id,
        ));

        $recommend_works = Work::where('is_recommend', true)
            ->where('is_show', true)->orderby('sort_order', 'asc')->limit(16)->get();

        return view('home.out.works', compact('works', 'recommend_works','categories','category_id'));

    }

    //成功案例详情
    public function work($id)
    {
        $work = Work::with(['category', 'doctor'])->find($id);
        $work['prev_data'] = Work::where('sort_order', '<=', $work->sort_order)->where('id', '!=', $work->id)->first();
        $work['next_data'] = Work::where('sort_order', '>=', $work->sort_order)->where('id', '!=', $work->id)->first();

        $hospitals = Hospital::where('is_recommend', true)->where('is_show', true)->orderby('sort_order', 'asc')->limit(6)->get();

        $recommend_works = Work::where('is_recommend', true)
            ->where('is_show', true)->orderby('sort_order')->limit(16)->get();

        $recommend_articles = Article::where('is_recommend', true)
            ->where('is_show', true)->orderby('sort_order')->limit(6)->get();


        return view('home.out.work', compact('work', 'recommend_works', 'recommend_articles', 'hospitals'));
    }

}
