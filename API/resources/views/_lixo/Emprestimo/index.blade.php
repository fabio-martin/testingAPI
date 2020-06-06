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
                                <th>Processo</th>
                                <th>Capital</th>
                                <th>Divida</th>
                                <th>Prest</th>
                                <th>Nº Prest</th>
                                <th>Prest Pag</th>
                                <th>Taxa</th>
                                <th>Seguro</th>
                                <th>Imposto Selo</th>
                                <th>Data Emp</th>
                                <th>Data Pag</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($emprestimos as $emprestimo)
                                <tr>
                                    <td>{{$emprestimo->Processo}}</td>
                                    <td>{{$emprestimo->Capital}}</td>
                                    <td>{{$emprestimo->Divida}}</td>
                                    <td>{{$emprestimo->Prest}}</td>
                                    <td>{{$emprestimo->NrPrest}}</td>
                                    <td>{{$emprestimo->PrestPag}}</td>
                                    <td>{{$emprestimo->Taxa}}</td>
                                    <td>{{$emprestimo->Seguro}}</td>
                                    <td>{{$emprestimo->ImpostoSelo}}</td>
                                    <td>{{$emprestimo->DataEmp}}</td>
                                    <td>{{$emprestimo->DataPag}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card-footer clearfix ">
                    <div class="row">
                        <div class="col-md-12">
                        {{ $emprestimos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
