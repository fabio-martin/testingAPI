<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'name',
        'nif',
        'email',
        'phone'
    ];

    public function orders(){
        return $this->hasMany('App\Model\Order')->where('active', 1);
    }
}
