<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'IP_address',
        'house_id',
        'created_at',
    ];

    public $timestamps = false;

    public function house() {
        return $this->belongsTo('App\House');
    }
}
