<?php

namespace App\Http\Controllers;

use App\Admin\Models\About\Article;
use App\Admin\Models\About\Company;
use App\Admin\Models\About\Contact;
use App\Admin\Models\About\Job;
use App\Admin\Models\About\Join;
use App\Admin\Models\Cms\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function __construct()
    {
        //联系方式
        $contacts = Contact::first();

        $company = Company::first();

        //广告
        $ads = Ads::where('is_show', true)->orderby('sort_order')->get();

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
            'zy_means' => $zy_means,
            'company' => $company,
            'contacts' => $contacts,
            'ads' => $ads,
            'search_keywords' => $search_keywords,
        ]);


    }

    public function articles(Request $request)
    {
        $articles = Article::where('is_show', true)->orderby('sort_order','asc')->paginate(env('PAGE_SIZE'));

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
        ));

        return view('home.about.articles', compact('articles'));
    }


    public function article($id)
    {
        $article = Article::find($id);

        $article['prev_data']=Article::where('sort_order','<=',$article->sort_order)->where('id','!=',$article->id)->first();
        $article['next_data']=Article::where('sort_order','>=',$article->sort_order)->where('id','!=',$article->id)->first();

        return view('home.about.article', compact('article'));
    }


    public function company()
    {


        return view('home.about.company');
    }

    public function join()
    {
        return view('home.about.join');
    }


    public function join_us(Request $request)
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

    public function job()
    {
        $jobs = Job::where('is_show', true)->orderby('sort_order', 'asc')->get();

        return view('home.about.job', compact('jobs'));
    }

    public function content()
    {
        return view('home.about.content');
    }
}
