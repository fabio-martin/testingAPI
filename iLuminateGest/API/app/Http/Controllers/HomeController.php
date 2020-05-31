<?php

namespace App\Http\Controllers;

use App\Model\Beneficiario;
use App\Model\Concurso;
use App\Model\Documento;
use App\Model\Ementa;
use App\Model\Protocolo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $titulo="Dashboard";
        //echo ">>>>".auth()->user()->NSERVI;

//        $totalDocumentos = Documento::where('Eliminado', 'N')->where('autorizado', 'S')->where('tipo', 'Documentos')->where('data', '<=', Carbon::now()->subDays(1))->where('datafim', '>=', Carbon::now()->subDays(1))->get()->count();
//        $totalEmentas = Ementa::where('Dia', '>=', Carbon::now()->subDay())->take(7)->get()->count();
//        $totalBeneficiarios = Beneficiario::where('NUM_BENEFICIARIO', auth()->user()->NSERVI)->where('DATA_FIM', null)->orderBy('ID_COD_FAMILIAR')->get()->count();
//        $totalConcursos = Concurso::where('PedAberto', 'true')->where('DataVis', '<=' ,Carbon::now()->subDay())->where('DataFim', '>=' ,Carbon::now()->subDay())->get()->count();
//        $totalProtocolo = Protocolo::where('Eliminado', 'N')->where('autorizado', 'S')->where('tipo', 'Protocolos')->where('data', '<=', Carbon::now()->subDays(1))->where('datafim', '>=', Carbon::now()->subDays(1))->get()->count();

        return view('home', compact(['titulo']));
    }
}
