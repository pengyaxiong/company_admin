<?php

namespace App\Http\Controllers\Mobile;

use App\Admin\Models\About\Company;
use App\Admin\Models\About\Contact;
use App\Admin\Models\Cms\Ads;
use App\Admin\Models\Cms\Article;
use App\Admin\Models\Cms\KnowCategory;
use App\Admin\Models\Other\ArticleCategory;
use App\Admin\Models\Other\Banner;
use App\Admin\Models\Other\Field;
use App\Admin\Models\Other\Organization;
use App\Admin\Models\Other\Service;
use App\Admin\Models\Out\Doctor;
use App\Admin\Models\Out\Hospital;
use App\Admin\Models\Out\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    public function __construct()
    {
        //联系方式
        $contacts = Contact::first();

        //广告
        $ads = Ads::where('is_show', true)->where('type', false)->orderby('sort_order')->get();

        $company = Company::first();

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

    public function index()
    {
        $sidles = Banner::where('is_ads', true)->orderby('sort_order')->get();
        $banners = Banner::where('is_ads', false)->orderby('sort_order')->get();

        $fields = Field::orderby('sort_order')->limit(5)->get();

        $hospitals = Hospital::where('is_show', true)->where('is_recommend', true)->orderby('sort_order', 'asc')->limit(6)->get();
        $doctors = Doctor::with('hospital')->where('is_show', true)->where('is_recommend', true)->orderby('sort_order', 'asc')->limit(6)->get();

        $works = Work::where('is_show', true)->where('is_recommend', true)->orderby('sort_order', 'asc')->limit(4)->get();

        $services = Service::orderby('sort_order', 'asc')->limit(4)->get();

        $categories = ArticleCategory::with(['articles' => function ($query) {
            $query->where('is_show', true)->orderBy('sort_order', 'asc');
        }])->orderby('sort_order', 'asc')->get();

        return view('mobile.index', compact('sidles', 'banners', 'fields', 'hospitals', 'doctors', 'works', 'services', 'categories'));
    }


    public function search(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            //   Cache::put('search_keywords',$keyword,24*60);
            $have = Cache::store('database')->has($keyword);
            if ($have) {
                DB::table('cache')->where('key', '_cache' . $keyword)->increment('num');
            } else {
                $minutes = 24 * 60;
                Cache::store('database')->put($keyword, $keyword, $minutes);
            }
        }

        return $keyword;
    }

    public function articles(Request $request)
    {
        $id = $request->id ? $request->id : ArticleCategory::orderby('sort_order')->first()->id;

        $articles = \App\Admin\Models\Other\Article::where('is_show', true)->where('category_id', $id)->orderby('sort_order', 'asc')->paginate(env('PAGE_SIZE'));

        $category_name=ArticleCategory::find($id);

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
        ));

        //知识百科
        $know_means = KnowCategory::with(['children' => function ($query) {
            $query->where('is_show', true)->orderby('sort_order');
        }])->where('is_show', true)->where('parent_id', 0)->orderby('sort_order')->get();

        return view('mobile.articles', compact('articles','category_name','know_means'));
    }

    public function article($id)
    {
        $article = \App\Admin\Models\Other\Article::with('category')->find($id);

        $article['prev_data']=\App\Admin\Models\Other\Article::where('sort_order','<=',$article->sort_order)->where('id','!=',$article->id)->first();
        $article['next_data']=\App\Admin\Models\Other\Article::where('sort_order','>=',$article->sort_order)->where('id','!=',$article->id)->first();

        $recommend_articles=\App\Admin\Models\Other\Article::where('is_recommend', true)->where('category_id', $article->category_id)
            ->where('is_show', true)->orderby('sort_order')->limit(16)->get();

        //知识百科
        $know_means = KnowCategory::with(['children' => function ($query) {
            $query->where('is_show', true)->orderby('sort_order');
        }])->where('is_show', true)->where('parent_id', 0)->orderby('sort_order')->get();


        return view('mobile.article', compact('article','recommend_articles','know_means'));
    }

    //生殖机构大全
    public function organizations(Request $request)
    {

        $organizations = Organization::where('is_show', true)->orderby('sort_order', 'asc')->paginate(env('PAGE_SIZE'));

        $page = isset($page) ? $request['page'] : 1;

        $organizations = $organizations->appends(array(
            'page' => $page,
        ));

        $articles = Article::where('is_show', true)->where('is_recommend', true)->orderby('sort_order', 'asc')->limit(16)->get();

        return view('mobile.organizations', compact('organizations', 'articles'));
    }

    public function organization($id)
    {
        $organization = Organization::find($id);

        $articles = Article::where('is_show', true)->where('is_hot', true)->orderby('sort_order', 'asc')->limit(6)->get();

        return view('mobile.organization', compact('organization', 'articles'));
    }
}
