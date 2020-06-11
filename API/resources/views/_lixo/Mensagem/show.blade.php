@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')


    <div class="row">
        <div class="col-md-3">
            <a href="compose.html" class="btn btn-primary btn-block mb-3">Compose</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pastas</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="/mensagem/" class="nav-link">
                                <i class="fas fa-inbox"></i> Lidas
                                <span class="badge bg-primary float-right">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-envelope"></i> Não Lidas
                                <span class="badge bg-warning float-right">5</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Ler Mensagem</h3>

                    <div class="card-tools">
                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="mailbox-read-info">
                        <h5>{{$mensagem->assunto}}</h5>
                        <h6>De: {{$mensagem->de}}
                            <span class="mailbox-read-time float-right">{{$mensagem->CriadoEm}}</span></h6>
                    </div>
                    <div class="mailbox-read-message">
                        {!! $mensagem->mensagem !!}
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Apagar</button>
                    <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</button>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>


@stop
