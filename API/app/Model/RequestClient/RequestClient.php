<?php

namespace App\Model\RequestClient;

use App\Model\Category\Category;
use App\Model\Provenance\Provenance;
use Illuminate\Database\Eloquent\Model;

class RequestClient extends Model
{
protected $table = "requests";

   protected $fillable = [
       'idProvenance'
   ];

    public function provenance()
    {
        return $this->hasOne(Provenance::class, 'id','idProvenance');
    }

    public function states()
    {
        return $this->hasMany(RequestClientStateRel::class, 'idRequest', 'id')->with('state')->where('active', 1)->orderByDesc('id');
    }


}