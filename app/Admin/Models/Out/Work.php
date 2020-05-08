<?php

namespace App\Admin\Models\Out;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'out_works';


    public function category()
    {
        return $this->belongsTo(WorkCategory::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


}
