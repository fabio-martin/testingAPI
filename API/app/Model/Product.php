<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'price'
    ];

    public function category(){
        return $this->belongsTo('\App\Model\Category')->where('active', 1);
    }

    public function orders(){
        return $this
            ->belongsToMany(Order::class)
            ->withTimestamps()
            ->wherePivot('active', 1);
    }

    public function warehouses(){
        return $this
            ->belongsToMany(Warehouse::class)
            ->withPivot(['stock', 'units_of_measure'])
            ->withTimestamps()
            ->wherePivot('active', 1);
    }
}
