<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Provenance extends Model
{
    protected $fillable = [
        'location',
        'color'
    ];

    public function orders(){
        return $this->hasMany('\App\Model\Order')->where('active', 1);
    }
}
