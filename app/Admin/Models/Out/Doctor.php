<?php

namespace App\Admin\Models\Out;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'out_doctors';

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function getTypeAttribute($type)
    {
        return array_values(json_decode($type, true) ?: []);
    }

    public function setTypeAttribute($type)
    {
        $this->attributes['type'] = json_encode(array_values($type));
    }
}
