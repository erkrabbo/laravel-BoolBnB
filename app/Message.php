<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = ['name', 'house_id', 'surname','sender_mail', 'content'];

    public function house() {
        return $this->belongsTo('App\House');
    }
}
