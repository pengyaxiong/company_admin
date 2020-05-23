<?php

namespace App\Http\Controllers\Mobile;

use App\Admin\Models\Cms\Article;
use App\Admin\Models\Cms\ArticleCategory;
use App\Admin\Models\Cms\Know;
use App\Admin\Models\Cms\KnowCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Admin\Models\About\Contact;
use App\Admin\Models\Cms\Ads;
use App\Http\Controllers\Controller;
class CmsController extends Controller
{
    public function __construct()
    {
        //联系方式
        $contacts = Contact::first();

        //广告
        $ads=Ads::where('is_show', true)->where('type', false)->orderby('sort_order')->get();

        $zy_means = \App\Admin\Models\Cms\ArticleCategory::has('articles')->where('is_show', true)->orderby('sort_order', 'asc')->get();

        //知识百科
        $know_means = KnowCategory::with(['children' => function ($query) {
            $query->where('is_show', true)->orderby('sort_order');
        }])->where('is_show', true)->where('parent_id', 0)->orderby('sort_order')->get();

        $search_keywords = [];
        $keys = DB::table('cache')->orderBy('num', 'desc')->limit(16)->pluck('key')->toArray();
        if (!empty($keys)) {
            foreach ($keys as $k => $key) {
                $keyword = Str::after($key, '_cache');
                $search_keywords[$k] = Cache::store('database')->get($keyword);
            }
        }

        view()->share([
            'zy_means' => $zy_means,
            'contacts' => $contacts,
            'know_means' => $know_means,
            'ads' => $ads,
            'search_keywords' => $search_keywords,
        ]);

    }

    //试管专题栏目
    public function article_categories( )
    {

        $categories = ArticleCategory::with('articles')->where('is_show', true)->orderby('sort_order', 'asc')->get();

        $today = Article::where('is_show', true)->where('is_today', true)->orderby('sort_order')->limit(9)->get();

        return view('mobile.cms.article_categories', compact('categories', 'today'));
    }

    public function today_articles(Request $request)
    {
        $articles = Article::with('category')->where('is_today', true)
            ->where('is_show', true)->orderby('sort_order')->paginate(env('PAGE_SIZE'));
        $category_name=['name'=>"今日资讯"];

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
        ));

        return view('mobile.cms.articles', compact('articles','category_name'));
    }

    //试管专题文章
    public function articles(Request $request)
    {
        $id = $request->id ? $request->id : ArticleCategory::where('is_show', true)->orderby('sort_order')->first()->id;

        $articles = Article::where('is_show', true)->where('category_id', $id)->orderby('sort_order', 'asc')->paginate(env('PAGE_SIZE'));

        $category_name=ArticleCategory::find($id);

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
        ));

        return view('mobile.cms.articles', compact('articles','category_name'));

    }

    //试管专题文章详情
    public function article($id)
    {
        $article = Article::with('category')->find($id);

        $article['prev_data']=Article::where('sort_order','<=',$article->sort_order)->where('id','!=',$article->id)->first();
        $article['next_data']=Article::where('sort_order','>=',$article->sort_order)->where('id','!=',$article->id)->first();

        $recommend_articles=Article::where('is_recommend', true)->where('category_id', $article->category_id)
            ->where('is_show', true)->orderby('sort_order')->limit(16)->get();

        return view('mobile.cms.article', compact('article','recommend_articles'));
    }

    //知识百科文章
    public function knows(Request $request)
    {

        $id = $request->id ? $request->id : KnowCategory::where('is_show', true)->where('parent_id', '>',0)->orderby('sort_order')->first()->id;

        $category=KnowCategory::find($id);


        $hot = Know::where('is_show', true)->where('is_hot', true)->where('category_id', $id)->orderby('sort_order')->limit(11)->get();

        $all_new = Know::where('is_show', true)->where('is_hot', true)->orderby('sort_order')->limit(6)->get();
        $all_hot = Know::where('is_show', true)->where('is_hot', true)->orderby('sort_order')->limit(6)->get();

        $recommend = Know::where('is_show', true)->where('is_recommend', true)->where('category_id', $id)->orderby('sort_order')->limit(4)->get();

        $cyclopedia = Know::where('is_show', true)->where('is_cyclopedia', true)->where('category_id', $id)->orderby('sort_order')->limit(6)->get();


        return view('mobile.cms.knows', compact('recommend','category','cyclopedia','hot' ,'all_hot','all_new'));

    }

    //知识百科文章详情
    public function know($id)
    {
        $article = Know::find($id);

        $recommend_articles = Know::where('is_show', true)->where('is_recommend', true)->where('category_id', $article->category_id)->orderby('sort_order')->limit(16)->get();

        $article['prev_data'] = Know::where('sort_order','<=',$article->sort_order)->where('id','!=',$article->id)->first();
        $article['next_data'] = Know::where('sort_order','>=',$article->sort_order)->where('id','!=',$article->id)->first();

        return view('mobile.cms.know', compact('article', 'recommend_articles'));
    }
}
