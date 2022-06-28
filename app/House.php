<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{

    protected $fillable = [
        'user_id',
        'Title',
        'Poster',
        'Content',
        'Night_price',
        'N_of_rooms',
        'N_of_beds',
        'N_of_baths',
        'Mq',
        'Available_from',
        'Available_to',
        'Address',
        'Visible',
        'Lat',
        'Lng',
    ];

    public function user(){
        return $this->belongsToMany('App\User');
    }

    public function views(){
        return $this->hasMany('App\Views');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function house_images() {
        return $this->hasMany('App\HouseImage');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function sponsorizations()
    {
        return $this->belongsToMany(Sponsorization::class)->withPivot('created_at', 'expiration_date');
    }

    public function notHavingImageInDb()
    {
        return (empty($this->Poster)) ? true : false;
    }
}
