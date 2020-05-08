<?php

namespace App\Admin\Models\Out;

use Illuminate\Database\Eloquent\Model;

class WorkCategory extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'out_work_categories';

    public $timestamps = false;

    public function works()
    {
        return $this->hasMany(Work::class);
    }
}
