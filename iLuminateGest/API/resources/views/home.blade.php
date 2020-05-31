@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <div class="card">
                <div class="card-body">
{{--                    <p class="mb-0">You are logged in!</p>--}}
                    <img src="{{ asset('images/logo.gif') }}" class="" alt="ISEL" style="width: 20%">
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
{{--        <div class="row">--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <div class="small-box bg-info">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>{{$totalBeneficiarios}}</h3>--}}

{{--                        <p>Beneficiário</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="fa fa-user"></i>--}}
{{--                    </div>--}}
{{--                    <a href="/beneficiario" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <div class="small-box bg-success">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>{{$totalEmentas}}</h3>--}}

{{--                        <p>Ementas</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="fa fa-utensils"></i>--}}
{{--                    </div>--}}
{{--                    <a href="/ementa" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <div class="small-box bg-success">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>53<sup style="font-size: 20px">%</sup></h3>--}}

{{--                        <p>Bounce Rate</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="ion ion-stats-bars"></i>--}}
{{--                    </div>--}}
{{--                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <div class="small-box bg-warning">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>{{$totalDocumentos}}</h3>--}}

{{--                        <p>Documentos</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="fa fa-file"></i>--}}
{{--                    </div>--}}
{{--                    <a href="/documento" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <div class="small-box bg-fuchsia">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>{{$totalProtocolo}}</h3>--}}

{{--                        <p>Protocolos</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="fa fa-file-pdf"></i>--}}
{{--                    </div>--}}
{{--                    <a href="/protocolo" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- ./col -->--}}
{{--            <div class="col-lg-3 col-6">--}}
{{--                <!-- small box -->--}}
{{--                <div class="small-box bg-danger">--}}
{{--                    <div class="inner">--}}
{{--                        <h3>{{$totalConcursos}}</h3>--}}

{{--                        <p>Concursos</p>--}}
{{--                    </div>--}}
{{--                    <div class="icon">--}}
{{--                        <i class="fa fa-pencil-alt" aria-hidden="true"></i>--}}
{{--                    </div>--}}
{{--                    <a href="#" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
@stop
