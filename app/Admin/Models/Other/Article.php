<?php

namespace App\Admin\Models\Other;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'other_articles';

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
