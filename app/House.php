<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function house_images() {
        return $this->hasMany('App\HouseImage');
    }

}
