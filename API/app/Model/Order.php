<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'provenance_id',
        'description',
        'date'
    ];

    public function client(){
        return $this->belongsTo('App\Model\Client')->where('active', 1);
    }

    public function states(){
        return $this
            ->belongsToMany(State::class)
            ->withTimestamps()
            ->wherePivot('active', 1);
    }

    public function products(){
        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity', 'products_total_price'])
            ->withTimestamps()
            ->wherePivot('active', 1);

    }

    public function provenance(){
        return $this->belongsTo('\App\Model\Provenance')->where('active', 1);
    }
}
