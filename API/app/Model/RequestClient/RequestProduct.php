<?php

namespace App\Model\RequestClient;

use App\Model\Category\Category;
use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{

    protected $fillable = [
        'idRequest',
        'idProduct'
    ];




}