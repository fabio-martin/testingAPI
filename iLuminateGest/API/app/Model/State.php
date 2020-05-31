<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $fillable = [
        'option',
        'color'
    ];

    public function orders(){
        return $this
            ->belongsToMany(Order::class)
            ->withTimestamps()
            ->wherePivot('active', 1);
    }

}
