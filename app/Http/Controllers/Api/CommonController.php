<?php

namespace App\Http\Controllers\Api;

use App\Admin\Models\Cms\Ads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommonController extends Controller
{
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

        return $this->null();
    }


    public function hot_search()
    {

        $keys = DB::table('cache')->orderBy('num', 'desc')->limit(16)->pluck('key')->toArray();
        if (!empty($keys)) {
            foreach ($keys as $k => $key) {
                $keyword = Str::after($key, '_cache');
                $search_keywords[$k] = Cache::store('database')->get($keyword);
            }
        }
        return $this->array($search_keywords);
    }

    //广告管理
    public function ads(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

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
        $ads = Ads::where($where)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $ads = $ads->appends(array(
            'page' => $page,
            'title' => $request['title'],
            'created_at' => $request['created_at'],
        ));

        return $this->object($ads);
    }
}
