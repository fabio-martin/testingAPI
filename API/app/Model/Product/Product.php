<?php

namespace App\Model\Product;

use App\Model\Category\Category;
use App\Warehouse\Warehouse;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'product',
        'idCategory',
        'price',

    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id','idCategory');
    }

    public function warehouses(){
        return $this
            ->belongsToMany(Warehouse::class)
            ->withPivot(['id','stock', 'units_of_measure'])
            ->withTimestamps()
            ->wherePivot('active', 1);
    }

}