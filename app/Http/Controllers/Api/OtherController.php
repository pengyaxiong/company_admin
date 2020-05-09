<?php

namespace App\Http\Controllers\Api;

use App\Admin\Models\Other\Article;
use App\Admin\Models\Other\ArticleCategory;
use App\Admin\Models\Other\Banner;
use App\Admin\Models\Other\Field;
use App\Admin\Models\Other\Organization;
use App\Admin\Models\Other\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtherController extends Controller
{
    //生殖机构大全
    public function organizations(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('name') and $request->name != '') {
                $search = "%" . $request->name . "%";
                $query->where('name', 'like', $search);
            }
            $query->where('is_show', true);
        };

        $organizations = Organization::where($where)->orderby('sort_order', 'asc')->get();

        return $this->object($organizations);
    }

    public function organization($id)
    {
        $organization = Organization::find($id);
        return $this->object($organization);
    }



    //轮播图
    public function banners()
    {
        $banners = Banner::orderby('sort_order', 'asc')->get();

        return $this->object($banners);
    }

    //专业领域
    public function fields()
    {
        $fields = Field::orderby('sort_order', 'asc')->get();

        return $this->object($fields);
    }

    //服务优势
    public function services()
    {
        $services = Service::orderby('sort_order', 'asc')->get();

        return $this->object($services);
    }

    //文章栏目
    public function article_categories(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('title') and $request->title != '') {
                $search = "%" . $request->title . "%";
                $query->where('title', 'like', $search);
            }

        };

        $categories = ArticleCategory::with('articles')->where($where)->orderby('sort_order', 'asc')->get();

        return $this->object($categories);
    }

    //文章
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
        $articles = Article::with('category')->where($where)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
            'title' => $request['title'],
            'category_id' => $request['category_id'],
            'is_recommend' => $request['is_recommend'],
            'created_at' => $request['created_at'],
        ));

        return $this->object($articles);
    }

    //文章文章详情
    public function article($id)
    {
        $article = Article::with('category')->find($id);

        $article['prev_data']=Article::where('sort_order','<',$article->sort_order)->first();
        $article['next_data']=Article::where('sort_order','>',$article->sort_order)->first();

        return $this->object($article);
    }
}
