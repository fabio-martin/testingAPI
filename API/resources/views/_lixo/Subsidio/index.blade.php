@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')

    {{$subsidios}}
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
                                <th>Nservi</th>
                                <th>Tipo</th>
                                <th>NºSubsidio</th>
                                <th>Rend.Iliq.</th>
                                <th>Agregado</th>
                                <th>Desp.Habitacao</th>
                                <th>Despesa</th>
                                <th>Comp.Subsistema</th>
                                <th>Nº Prest</th>
                                <th>Ano</th>
                                <th>Total Subsidio</th>
                                <th>Deferido</th>
                                <th>Motivo</th>
                                <th>Processado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subsidios as $subsidio)
                                <tr>
                                    <td>{{$subsidio->Nservi}}</td>
                                    <td>{{$subsidio->Nservi1}}</td>
                                    <td>{{$subsidio->Num_Subsidio}}</td>
                                    <td>{{$subsidio->RendIliquido}}</td>
                                    <td>{{$subsidio->Agregado}}</td>
                                    <td>{{$subsidio->DespHabitacao}}</td>
                                    <td>{{$subsidio->Despesa}}</td>
                                    <td>{{$subsidio->CompSubsistema}}</td>
                                    <td>{{$subsidio->NrPrest}}</td>
                                    <td>{{$subsidio->Ano}}</td>
                                    <td>{{$subsidio->TotalSubsidio}}</td>
                                    <td>{{$subsidio->Deferido}}</td>
                                    <td>{{$subsidio->Motivo}}</td>
                                    <td>{{$subsidio->Processado}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card-footer clearfix ">
                    <div class="row">
                        <div class="col-md-12">
                        {{ $subsidios->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
