<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function sponsorizations()
    {
        return $this->belongsToMany(Sponsorization::class);
    }
}
