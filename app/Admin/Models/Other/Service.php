<?php

namespace App\Admin\Models\Other;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'other_services';


    public function getDesAttribute($type)
    {
        return array_values(json_decode($type, true) ?: []);
    }

    public function setDesAttribute($type)
    {
        $this->attributes['des'] = json_encode(array_values($type));
    }

    public function getImageTextAttribute($type)
    {
        return array_values(json_decode($type, true) ?: []);
    }

    public function setImageTextAttribute($type)
    {
        $this->attributes['image_text'] = json_encode(array_values($type));
    }
}
