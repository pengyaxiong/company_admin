<?php

namespace App\Admin\Models\Other;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'other_banners';
}
