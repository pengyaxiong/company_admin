<?php

namespace App\Admin\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Know extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'cms_knows';

    // public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(KnowCategory::class);
    }

}
