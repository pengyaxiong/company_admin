<?php

namespace App\Admin\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'cms_informations';

    // public $timestamps = false;
}
