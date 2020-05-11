<?php

namespace App\Admin\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'cms_ads';
}
