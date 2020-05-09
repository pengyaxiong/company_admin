<?php

namespace App\Http\Controllers\Api;

use App\Admin\Models\Cms\Article;
use App\Admin\Models\Cms\ArticleCategory;
use App\Admin\Models\Cms\Information;
use App\Admin\Models\Cms\Know;
use App\Admin\Models\Cms\KnowCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    //今日资讯
    public function informations(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('is_recommend') and $request->is_recommend != '') {
                $query->where('is_recommend', true);
            }

            if ($request->has('title') and $request->title != '') {
                $search = "%" . $request->title . "%";
                $query->where('title', 'like', $search);
            }

            if ($request->has('created_at') and $request->created_at != '') {
                $time = explode(" ~ ", $request->input('created_at'));
                $start = $time[0] . ' 00:00:00';
                $end = $time[1] . ' 23:59:59';
                $query->whereBetween('created_at', [$start, $end]);
            }
            $query->where('is_show', true);
        };
        $informations = Information::where($where)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $informations = $informations->appends(array(
            'page' => $page,
            'title' => $request['title'],
            'created_at' => $request['created_at'],
        ));

        return $this->object($informations);
    }

    //今日资讯详情
    public function information($id)
    {
        $information = Information::find($id);

        $information['prev_data']=Information::where('sort_order','<',$information->sort_order)->first();
        $information['next_data']=Information::where('sort_order','>',$information->sort_order)->first();

        return $this->object($information);
    }


    //试管专题栏目
    public function article_categories(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('title') and $request->title != '') {
                $search = "%" . $request->title . "%";
                $query->where('title', 'like', $search);
            }

            $query->where('is_show', true);
        };

        $categories = ArticleCategory::with('articles')->where($where)->orderby('sort_order', 'asc')->get();

        return $this->object($categories);
    }

    //试管专题文章
    public function articles(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('title') and $request->title != '') {
                $search = "%" . $request->title . "%";
                $query->where('title', 'like', $search);
            }

            if ($request->has('category_id') and $request->category_id != '') {
                $query->where('category_id', $request->category_id);
            }

            if ($request->has('is_hot')) {
                $query->where('is_hot', $request->is_hot);
            }

            if ($request->has('is_new')) {
                $query->where('is_new', $request->is_new);
            }

            if ($request->has('is_recommend')) {
                $query->where('is_recommend', $request->is_recommend);
            }

            if ($request->has('created_at') and $request->created_at != '') {
                $time = explode(" ~ ", $request->input('created_at'));
                $start = $time[0] . ' 00:00:00';
                $end = $time[1] . ' 23:59:59';
                $query->whereBetween('created_at', [$start, $end]);
            }
            $query->where('is_show', true);
        };
        $articles = Article::where($where)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'is_hot' => $request['is_hot'],
            'is_new' => $request['is_new'],
            'is_recommend' => $request['is_recommend'],
            'created_at' => $request['created_at'],
        ));

        return $this->object($articles);
    }

    //试管专题文章详情
    public function article($id)
    {
        $article = Article::find($id);
        $article['prev_data']=Article::where('sort_order','<',$article->sort_order)->first();
        $article['next_data']=Article::where('sort_order','>',$article->sort_order)->first();
        return $this->object($article);
    }

    //知识百科栏目
    public function know_categories(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('title') and $request->title != '') {
                $search = "%" . $request->title . "%";
                $query->where('title', 'like', $search);
            }

            $query->where('is_show', true);

            $query->where('parent_id', 0);
        };

        $categories = KnowCategory::with(['children' => function ($query) {
            $query->with(['knows' => function ($query) {
                 $query->where('is_show', true);
            }])->where('is_show', true)->orderBy('sort_order');
        }])->where($where)->orderby('sort_order', 'asc')->get();

        return $this->object($categories);
    }

    //知识百科文章
    public function knows(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('title') and $request->title != '') {
                $search = "%" . $request->title . "%";
                $query->where('title', 'like', $search);
            }

            if ($request->has('category_id') and $request->category_id != '') {
                $query->where('category_id', $request->category_id);
            }

            if ($request->has('is_hot')) {
                $query->where('is_hot', $request->is_hot);
            }

            if ($request->has('is_new')) {
                $query->where('is_new', $request->is_new);
            }

            if ($request->has('is_recommend')) {
                $query->where('is_recommend', $request->is_recommend);
            }

            if ($request->has('created_at') and $request->created_at != '') {
                $time = explode(" ~ ", $request->input('created_at'));
                $start = $time[0] . ' 00:00:00';
                $end = $time[1] . ' 23:59:59';
                $query->whereBetween('created_at', [$start, $end]);
            }
            $query->where('is_show', true);
        };
        $knows = Know::where($where)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $knows = $knows->appends(array(
            'page' => $page,
            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'is_hot' => $request['is_hot'],
            'is_new' => $request['is_new'],
            'is_recommend' => $request['is_recommend'],
            'created_at' => $request['created_at'],
        ));

        return $this->object($knows);
    }

    //知识百科文章详情
    public function know($id)
    {
        $know = Know::find($id);
        $know['prev_data']=Know::where('sort_order','<',$know->sort_order)->first();
        $know['next_data']=Know::where('sort_order','>',$know->sort_order)->first();
        return $this->object($know);
    }
}
