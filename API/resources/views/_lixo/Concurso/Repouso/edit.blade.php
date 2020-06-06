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
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Alterar Pedido {{$repouso->Cod_Concurso}} Nº {{$repouso->Id}}</h3>
                </div>
                <form role="form" method="POST" action="/repouso/update" id="formAlterarRepouso">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Casa">Casa</label>
                                    <input type="text" disabled value="{{$repouso->casa()->DESIGNCASA}}" class="form-control" id="Casa" name="Casa" placeholder="" required maxlength="9" minlength="9">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="telefone">Contacto</label>
                                    <input type="text" value="{{$repouso->telefone}}" class="form-control" id="telefone" name="telefone" placeholder="" required maxlength="9" minlength="9">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="NIB">NIB</label>
                                    <input type="text" value="{{$repouso->NIB}}" class="form-control" id="NIB" name="NIB" placeholder="" required maxlength="21" minlength="21">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Diaria">Diária</label>
                                    <input type="text" disabled value="{{$repouso->Diaria}}" class="form-control" id="Diaria" name="Diaria" placeholder="" required maxlength="9" minlength="9">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="DATAENT">Entrada</label>
                                    <input type="text" value="{{$repouso->DATAENT}}" class="form-control" id="DATAENT" name="DATAENT" placeholder="" required maxlength="9" minlength="9">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="DATASAI">Saida</label>
                                    <input type="text" value="{{$repouso->DATASAI}}" class="form-control" id="DATASAI" name="DATASAI" placeholder="" required maxlength="9" minlength="9">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="AGREGADO">Agregado</label>
                                    <select name="AGREGADO" id="AGREGADO" class="custom-select">
                                        @for ($i = 1; $i <= $casas->max('LOTACAO'); $i++)
                                            <option {{$repouso->AGREGADO == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ACOMP">Acompanhantes</label>
                                    <select name="ACOMP" id="ACOMP" class="custom-select">
                                        @for ($i = 0; $i < $casas->max('LOTACAO'); $i++)
                                            <option {{$repouso->ACOMP == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Desistiu">Desistiu</label>
                                    <input type="text" disabled value="{{$repouso->Eliminado}}" class="form-control" id="Eliminado" name="Eliminado" placeholder="" required maxlength="9" minlength="9">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Penalisa">Penaliza</label>
                                    <input type="text" disabled value="{{$repouso->PENALIZA}}" class="form-control" id="PENALIZA" name="PENALIZA" placeholder="" required maxlength="9" minlength="9">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <button type="submit" class="btn btn-primary col-2">Alterar</button>
                        <button type="reset" class="btn btn-secondary col-2">Limpar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@stop
