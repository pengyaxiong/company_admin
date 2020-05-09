<?php

namespace App\Http\Controllers\Api;

use App\Admin\Models\Out\Article;
use App\Admin\Models\Out\Doctor;
use App\Admin\Models\Out\Hospital;
use App\Admin\Models\Out\Work;
use App\Admin\Models\Out\WorkCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutController extends Controller
{
    //名医荟萃
    public function doctors(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('is_recommend') and $request->is_recommend != '') {
                $query->where('is_recommend', true);
            }

            if ($request->has('hospital_id') and $request->hospital_id != '') {
                $query->where('hospital_id', $request->hospital_id);
            }

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
        $doctors = Doctor::with(['hospital', 'works'])->where($where)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $doctors = $doctors->appends(array(
            'page' => $page,
            'hospital_id' => $request['hospital_id'],
            'name' => $request['name'],
            'created_at' => $request['created_at'],
        ));

        return $this->object($doctors);
    }

    //名医荟萃详情
    public function doctor($id)
    {
        $doctor = Doctor::with(['hospital', 'works'])->find($id);

        return $this->object($doctor);
    }

    //成功案例栏目
    public function work_categories(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('title') and $request->title != '') {
                $search = "%" . $request->title . "%";
                $query->where('title', 'like', $search);
            }
        };

        $categories = WorkCategory::with(['works' => function ($query) {
                $query->where('is_show', true)->orderBy('sort_order', 'asc');
        }])->where($where)->orderby('sort_order', 'asc')->get();

        return $this->object($categories);
    }
    //成功案例
    public function works(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('is_recommend') and $request->is_recommend != '') {
                $query->where('is_recommend', true);
            }

            if ($request->has('category_id') and $request->category_id != '') {
                $query->where('category_id', $request->category_id);
            }

            if ($request->has('doctor_id') and $request->doctor_id != '') {
                $query->where('doctor_id', $request->doctor_id);
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
        $works = Work::with(['category', 'doctor'])->where($where)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $works = $works->appends(array(
            'page' => $page,
            'category_id' => $request['category_id'],
            'doctor_id' => $request['doctor_id'],
            'title' => $request['title'],
            'created_at' => $request['created_at'],
        ));

        return $this->object($works);

    }
    //成功案例详情
    public function work($id)
    {
        $work = Work::with(['category', 'doctor'])->find($id);
        $work['prev_data']=Work::where('sort_order','<',$work->sort_order)->first();
        $work['next_data']=Work::where('sort_order','>',$work->sort_order)->first();
        return $this->object($work);
    }

    //海外医院
    public function hospitals(Request $request)
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
        $articles = Hospital::where($where)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
            'name' => $request['name'],
            'created_at' => $request['created_at'],
        ));

        return $this->object($articles);
    }
    //海外医院详情
    public function hospital($id)
    {
        $hospital = Hospital::with('doctors')->find($id);

        return $this->object($hospital);
    }

    //试管套餐
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
        $articles = Article::where($where)->orderby('sort_order', 'asc')->paginate($request->total);

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
            'is_recommend' => $request['is_recommend'],
            'title' => $request['title'],
            'created_at' => $request['created_at'],
        ));

        return $this->object($articles);
    }
    //试管套餐详情
    public function article($id)
    {
        $article = Article::find($id);

        return $this->object($article);
    }
}
