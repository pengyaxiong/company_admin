<?php

namespace App\Http\Controllers\Api;

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

        $keys = DB::table('cache')->orderBy('num','desc')->limit(16)->pluck('key')->toArray();
        if (!empty($keys)) {
            foreach ($keys as $k => $key) {
                $keyword = Str::after($key, '_cache');
                $search_keywords[$k] = Cache::store('database')->get($keyword);
            }
        }
        return $this->array($search_keywords);
    }
}
