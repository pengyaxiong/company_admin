<?php

namespace App\Admin\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'cms_article_categories';

    // public $timestamps = false;

    public function articles()
    {
        return $this->hasMany(Article::class,'category_id');
    }
}
