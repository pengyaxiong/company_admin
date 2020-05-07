<?php

namespace App\Admin\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'cms_articles';

    // public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
