<?php

namespace App\Model\Category;

use App\Model\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'category', 'image'
    ];

    protected $hidden = [
       // 'created_at', 'updated_at'
    ];

    public function totalProducts()
    {
        return Product::where('active', 1)->where('idCategory', $this->id)->count();
    }


}
