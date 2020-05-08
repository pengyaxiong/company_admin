<?php

namespace App\Admin\Models\Out;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'out_hospitals';

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
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
