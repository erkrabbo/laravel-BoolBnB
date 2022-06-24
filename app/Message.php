<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = ['name', 'surname','sender_mail', 'content'];
    public function house() {
        return $this->belongsTo('App\House');
    }
}
