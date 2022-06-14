<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
<<<<<<< HEAD
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function views(){
        return $this->hasMany('App\Views');
    }
=======
    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function house_images() {
        return $this->hasMany('App\HouseImage');
    }

>>>>>>> prova-pier
}
