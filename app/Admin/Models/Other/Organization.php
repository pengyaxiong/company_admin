<?php

namespace App\Admin\Models\Other;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //黑名单为空
    protected $guarded = [];

    public function getTypeAttribute($type)
    {
        return array_values(json_decode($type, true) ?: []);
    }

    public function setTypeAttribute($type)
    {
        $this->attributes['type'] = json_encode(array_values($type));
    }


    public function getDoctorAttribute($type)
    {
        return array_values(json_decode($type, true) ?: []);
    }

    public function setDoctorAttribute($type)
    {
        $this->attributes['doctor'] = json_encode(array_values($type));
    }
}
