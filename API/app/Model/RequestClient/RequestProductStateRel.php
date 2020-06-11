<?php

namespace App\Model\RequestClient;

use App\Model\Category\Category;
use Illuminate\Database\Eloquent\Model;

class RequestProductStateRel extends Model
{

    protected $fillable = [
        'idProduct',
        'idState'
    ];




}