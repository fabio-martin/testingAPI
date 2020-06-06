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
                    <h3 class="card-title">Pedido</h3>
                </div>
                <form role="form" method="PUT" action="/concurso/{{$concursoVeraneio->concurso_id}}/veraneio/{{$concursoVeraneio->Id}}" id="formAlterarInscricao">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="telefone">Contacto</label>
                                    <input type="text" value="{{$concursoVeraneio->telefone}}" class="form-control" id="telefone" name="telefone" placeholder="" required maxlength="9" minlength="9">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="NIB">NIB</label>
                                    <input type="text" value="{{$concursoVeraneio->NIB}}" class="form-control" id="NIB" name="NIB" placeholder="" required maxlength="21" minlength="21">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="AGREGADO">Agregado</label>
                                    <select name="AGREGADO" id="AGREGADO" class="custom-select">
                                        @for ($i = 1; $i <= $casas->max('LOTACAO'); $i++)
                                            <option {{$concursoVeraneio->AGREGADO == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ACOMP">Acompanhantes</label>
                                    <select name="ACOMP" id="ACOMP" class="custom-select">
                                        @for ($i = 0; $i < $casas->max('LOTACAO'); $i++)
                                            <option {{$concursoVeraneio->ACOMP == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP1">Turno</label>
                                    <select name="TP1" id="TP1" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($turnos as $turno)
                                            <option {{$concursoVeraneio->TP1 == $turno->NumTurno ? 'selected' : ''}} value="{{$turno->NumTurno}}">{{$turno->NumTurno}}º de {{$turno->DataEnt}} a {{$turno->DataSai}}</option>
                                        @endforeach
                                    </select>
                                    {{--                               <input type="text" class="form-control" id="turno" name="turno" placeholder="" required>--}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP1CP1">Casa 1</label>
                                    <select name="TP1CP1" id="TP1CP1" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option {{$concursoVeraneio->TP1CP1 == $casa->CODGRUPO ? 'selected' : ''}} value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP1CP2">Casa 2</label>
                                    <select name="TP1CP2" id="TP1CP2" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option {{$concursoVeraneio->TP1CP2 == $casa->CODGRUPO ? 'selected' : ''}} value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP1CP3">Casa 3</label>
                                    <select name="TP1CP3" id="TP1CP3" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option {{$concursoVeraneio->TP1CP3 == $casa->CODGRUPO ? 'selected' : ''}} value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP2">Turno</label>
                                    <select name="TP2" id="TP2" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($turnos as $turno)
                                            <option {{$concursoVeraneio->TP2 == $turno->NumTurno ? 'selected' : ''}} value="{{$turno->NumTurno}}">{{$turno->NumTurno}}º de {{$turno->DataEnt}} a {{$turno->DataSai}}</option>
                                        @endforeach
                                    </select>
                                    {{--                               <input type="text" class="form-control" id="turno" name="turno" placeholder="" required>--}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP2CP1">Casa 1</label>
                                    <select name="TP2CP1" id="TP2CP1" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option {{$concursoVeraneio->TP2CP1 == $casa->CODGRUPO ? 'selected' : ''}} value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP2CP2">Casa 2</label>
                                    <select name="TP2CP2" id="TP2CP2" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option {{$concursoVeraneio->TP2CP2 == $casa->CODGRUPO ? 'selected' : ''}} value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP2CP3">Casa 3</label>
                                    <select name="TP2CP3" id="TP2CP3" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option {{$concursoVeraneio->TP2CP3 == $casa->CODGRUPO ? 'selected' : ''}} value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="turno">Turno</label>
                                    <select name="TP3" id="TP3" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($turnos as $turno)
                                            <option {{$concursoVeraneio->TP3 == $turno->NumTurno ? 'selected' : ''}} value="{{$turno->NumTurno}}">{{$turno->NumTurno}}º de {{$turno->DataEnt}} a {{$turno->DataSai}}</option>
                                        @endforeach
                                    </select>
                                    {{--                               <input type="text" class="form-control" id="turno" name="turno" placeholder="" required>--}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="turno">Casa 1</label>
                                    <select name="TP3CP1" id="TP3CP1" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option {{$concursoVeraneio->TP3CP1 == $casa->CODGRUPO ? 'selected' : ''}} value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="turno">Casa 2</label>
                                    <select name="TP3CP2" id="TP3CP2" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option {{$concursoVeraneio->TP3CP2 == $casa->CODGRUPO ? 'selected' : ''}} value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="turno">Casa 3</label>
                                    <select name="TP3CP3" id="TP3CP3" class="custom-select">
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option {{$concursoVeraneio->TP3CP3 == $casa->CODGRUPO ? 'selected' : ''}} value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
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
