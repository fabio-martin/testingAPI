@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
    @endif

    @if($message = Session::get('error'))
        <div class="alert alert-error">
            {{$message}}
        </div>
    @endif

    @if(count($errors)>0)
        <div class="alert alert-danger" id="error_validacao">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{$erro}}</li>
                @endforeach
            </ul>
        </div>
    @endif




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
                                <th>Acção</th>
                                <th>Inscrição</th>
                                <th>Concurso</th>
                                <th>Casa</th>
                                <th>Entrada</th>
                                <th>Saída</th>
                                <th>Penalizado</th>
                                <th>Nº Benef</th>
                                <th>Nº N/Benef</th>
                                <th>Diária</th>
                                <th>Desistiu</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repousos as $repouso)
                                <tr>
                                    <td>
                                        @if($repouso->DATAENT > $hoje)
                                        <a href="/repouso/{{$repouso->Id}}/edit"  type="button" class="btn  bg-gradient-success btn-md" data-toggle="tooltip" data-placement="right" title="Ver inscrições">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button href="/repouso/{{$repouso->Id}}/destroy"  type="button" class="btn  bg-gradient-danger btn-md" data-toggle="tooltip" data-placement="right" title="Ver inscrições">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        @else
                                        <button disabled type="button" class="btn  bg-gradient-success btn-md" data-toggle="tooltip" data-placement="right" title="Ver inscrições">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button disabled type="button" class="btn  bg-gradient-danger btn-md" data-toggle="tooltip" data-placement="right" title="Ver inscrições">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        @endif
                                    </td>
                                    <td>{{$repouso->Id}}</td>
                                    <td>{{$repouso->Cod_Concurso}}</td>
                                    <td>{{$repouso->casa()->DESIGNCASA}}</td>
                                    <td>{{$repouso->DATAENT}}</td>
                                    <td>{{$repouso->DATASAI}}</td>
                                    <td>{{$repouso->PENALIZA}}</td>
                                    <td>{{$repouso->AGREGADO}}</td>
                                    <td>{{$repouso->ACOMP}}</td>
                                    <td>{{$repouso->Diaria}}</td>
                                    <td>{{$repouso->Eliminado}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card-footer clearfix ">
                    <div class="row">
                        <div class="col-md-12">
                            {{ $repousos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
