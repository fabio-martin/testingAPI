<?php

namespace App\Warehouse;

use App\Model\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'location',
        'active'
    ];

    public function products(){
        return $this
            ->belongsToMany(Product::class)
            ->withPivot(['id','stock', 'units_of_measure'])
            ->withTimestamps()
            ->wherePivot('active', 1);
    }
}
