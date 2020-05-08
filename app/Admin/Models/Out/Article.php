<?php

namespace App\Admin\Models\Out;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'out_articles';
}
