@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Lista</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Género</th>
                                <th>Tipo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($beneficiarios as $beneficiario)
                                <tr>
                                    <td>{{$beneficiario->NUM_BENEFICIARIO}}{{$beneficiario->ID_COD_FAMILIAR}}</td>
                                    <td>{{$beneficiario->NOME}}</td>
                                    <td>{{$beneficiario->SEXO}}</td>
                                    <td><span class="badge badge-success">{{$beneficiario->tipo->DENOMINACAO}}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card-footer clearfix ">
                    <div class="row">
                        <div class="col-md-12">
                        {{ $beneficiarios->links() }}
                        </div>
                    </div>

                    {{--                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>--}}
                    {{--                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>--}}
                </div>
            </div>
        </div>
    </div>
@stop
