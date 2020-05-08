<?php

namespace App\Admin\Models\Other;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'other_fields';
}
