<?php

namespace App\Model\RequestClient;

use App\Model\Category\Category;
use Illuminate\Database\Eloquent\Model;

class RequestClientStateRel extends Model
{
    protected $table = "request_state_rels";

    protected $fillable = [
        'idRequest',
        'idState'
    ];

    public function state()
    {
        return $this->hasOne(RequestClientState::class, 'id','idState');
    }

}