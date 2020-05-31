<?php

namespace App\Model;

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
            ->withPivot(['stock', 'units_of_measure'])
            ->withTimestamps()
            ->where('active', 1);
    }
}
