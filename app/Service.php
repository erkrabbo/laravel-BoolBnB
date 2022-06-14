<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;

    public function houses()
    {
        return $this->belongsToMany(House::class);
    }
}
