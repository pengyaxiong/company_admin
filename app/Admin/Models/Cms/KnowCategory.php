<?php

namespace App\Admin\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class KnowCategory extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'cms_know_categories';

    // public $timestamps = false;


    public function knows()
    {
        return $this->hasMany(Know::class);
    }


    public function parent()
    {
        return $this->belongsTo(get_class($this));
    }


    public function children()
    {
        return $this->hasMany(get_class($this), 'parent_id');
    }

    static function get_parents()
    {
        return self::where('is_show', true)->where("parent_id", 0)
            ->orderBy('sort_order')->get()->toarray();
    }

    /**
     * 生成分类数据
     * @return mixed
     */
    static function get_categories()
    {
        return self::with(['children' => function ($query) {
            $query->where('is_show', true)->orderBy('sort_order');
        }])->where('is_show', true)->where("parent_id", 0)
            ->orderBy('sort_order')->get();
    }


    /**
     * 检查是否有子栏目
     */
    static function check_children($id)
    {
        $category = self::with('children')->find($id);
        if ($category->children->isEmpty()) {
            return true;
        }
        return false;
    }

    /**
     * 检查是否有文章
     */
    static function check_articles($id)
    {
        $category = self::with('articles')->find($id);
        if ($category->articles->isEmpty()) {
            return true;
        }
        return false;
    }
}
