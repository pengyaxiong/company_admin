<?php

namespace App\Http\Controllers\Api;

use App\Admin\Models\About\Article;
use App\Admin\Models\About\Company;
use App\Admin\Models\About\Contact;
use App\Admin\Models\About\Job;
use App\Admin\Models\About\Join;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    //新闻资讯列表
    public function articles(Request $request)
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
        $articles = Article::where($where)->orderby('sort_order','asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
            'title' => $request['title'],
        ));

        return $this->object($articles);
    }

    public function article($id)
    {
        $article = Article::find($id);

        $article['prev_data']=Article::where('sort_order','<',$article->sort_order)->first();
        $article['next_data']=Article::where('sort_order','>',$article->sort_order)->first();

        return $this->object($article);
    }

    //人才招聘
    public function job(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('name') and $request->name != '') {

                $search = "%" . $request->name . "%";
                $query->where('name', 'like', $search);
            }

            if ($request->has('created_at') and $request->created_at != '') {
                $time = explode(" ~ ", $request->input('created_at'));
                $start = $time[0] . ' 00:00:00';
                $end = $time[1] . ' 23:59:59';
                $query->whereBetween('created_at', [$start, $end]);
            }

            $query->where('is_show', true);
        };
        $jobs = Job::where($where)->orderby('sort_order','asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $jobs = $jobs->appends(array(
            'page' => $page,
            'name' => $request['name'],
        ));

        return $this->object($jobs);
    }


    //公司简介
    public function company()
    {
        $company = Company::all();
        return $this->object($company);
    }

    //加盟代理
    public function join(Request $request)
    {
        try {
            $messages = [
                'name.required' => '姓名不能为空!',
                'phone.required' => '联系方式不能为空!',
            ];
            $rules = [
                'phone' => 'required',
                'name' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $error = $validator->errors()->first();

                $this->error(500,$error);
            }
            Join::create($request->all());

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            $this->error(500,$exception->getMessage());
        }

        return $this->null();
    }

    //联系我们
    public function content()
    {
        $contact = Contact::first();

        return $this->object($contact);
    }

}
