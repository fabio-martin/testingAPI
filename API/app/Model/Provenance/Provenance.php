<?php

namespace App\Model\Provenance;

use Illuminate\Database\Eloquent\Model;

class Provenance extends Model
{
    protected $fillable = [
        'location',
        'color',
    ];
}
