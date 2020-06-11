<?php

namespace App\Http\Controllers;

use App\Model\RequestClient\RequestClient;
use Illuminate\Support\Facades\Response;
use JWTAuth;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $user;


    public function __construct()
    {
//        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {

        return Response::json(array(
            'requests' => RequestClient::where('active', 1)->with('provenance')->with('states')->get(),
        ));
    }

}
