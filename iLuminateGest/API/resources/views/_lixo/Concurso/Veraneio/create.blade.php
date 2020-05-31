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



    <form role="form" method="POST" action="/concurso/{{$idConcurso}}/veraneio" id="formAdicionarInscricao">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pedido</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="telefone">Contacto</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder=""
                                           required maxlength="9" minlength="9">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="NIB">NIB</label>
                                    <input type="number" class="form-control" id="NIB" name="NIB" placeholder="" required
                                           maxlength="21" minlength="21">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="AGREGADO">Agregado</label>
                                    <select name="AGREGADO" id="AGREGADO" class="custom-select" onchange="getCasas()">
                                        @for ($i = 1; $i <= $casas->max('LOTACAO'); $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ACOMP">Acompanhantes</label>
                                    <select name="ACOMP" id="ACOMP" class="custom-select" onchange="getCasas()">
                                        @for ($i = 0; $i < $casas->max('LOTACAO'); $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP1">Turno</label>
                                    <select name="TP1" id="TP1" class="custom-select select2"
                                            onchange="getCasasTurno(1)">
                                        <option value="">Selecione...</option>
                                        @foreach($turnos as $turno)
                                            <option value="{{$turno->NumTurno}}">{{$turno->NumTurno}}º
                                                de {{$turno->DataEnt}} a {{$turno->DataSai}}</option>
                                        @endforeach
                                    </select>
                                    {{--                               <input type="text" class="form-control" id="turno" name="turno" placeholder="" required>--}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP1CP1">Casa 1</label>
                                    <select name="TP1CP1" id="TP1CP1" class="custom-select select2 tp1casa" disabled>
                                        <option value="">Selecione...</option>
                                        @foreach($casas as $casa)
                                            <option
                                                value="{{$casa->CODGRUPO}}">{{$casa->DESIGNCASA}} {{$casa->RUA_AV}} {{$casa->CLASSE}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP1CP2">Casa 2</label>
                                    <select name="TP1CP2" id="TP1CP2" class="custom-select select2 tp1casa" disabled>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP1CP3">Casa 3</label>
                                    <select name="TP1CP3" id="TP1CP3" class="custom-select select2 tp1casa" disabled>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP2">Turno</label>
                                    <select name="TP2" id="TP2" class="custom-select" onchange="getCasasTurno(2)">
                                        <option value="">Selecione...</option>
                                        @foreach($turnos as $turno)
                                            <option value="{{$turno->NumTurno}}">{{$turno->NumTurno}}º
                                                de {{$turno->DataEnt}} a {{$turno->DataSai}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP2CP1">Casa 1</label>
                                    <select name="TP2CP1" id="TP2CP1" class="custom-select tp2casa" disabled>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP2CP2">Casa 2</label>
                                    <select name="TP2CP2" id="TP2CP2" class="custom-select tp2casa" disabled>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="TP2CP3">Casa 3</label>
                                    <select name="TP2CP3" id="TP2CP3" class="custom-select tp2casa" disabled>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="turno">Turno</label>
                                    <select name="TP3" id="TP3" class="custom-select" onchange="getCasasTurno(3)">
                                        <option value="">Selecione...</option>
                                        @foreach($turnos as $turno)
                                            <option value="{{$turno->NumTurno}}">{{$turno->NumTurno}}º
                                                de {{$turno->DataEnt}} a {{$turno->DataSai}}</option>
                                        @endforeach
                                    </select>
                                    {{--                               <input type="text" class="form-control" id="turno" name="turno" placeholder="" required>--}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="turno">Casa 1</label>
                                    <select name="TP3CP1" id="TP3CP1" class="custom-select tp3casa" disabled>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="turno">Casa 2</label>
                                    <select name="TP3CP2" id="TP3CP2" class="custom-select tp3casa" disabled>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="turno">Casa 3</label>
                                    <select name="TP3CP3" id="TP3CP3" class="custom-select tp3casa" disabled>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row fa-pull-right">
                            <div class="col-md-12">

                                <button type="reset" class="btn btn-secondary">Limpar</button>
                                <button type="submit" class="btn btn-primary">Inscrever</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </form>

@stop


@section('js')
    <script>


        $(document).ready(function () {

            // $('.select2').select2();
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        })


        function getCasas() {
            getCasasTurno(1);
            getCasasTurno(2);
            getCasasTurno(3);
        }


        function getCasasTurno(turno) {

            console.log('get casas para: ' + turno)
            var turnoSelect = $('#TP' + turno)

            var totalAgregados = parseInt($('#AGREGADO').val())
            var totalAcompanhantes = parseInt($('#ACOMP').val())

            var totalOcupantes = totalAgregados + totalAcompanhantes;

            if (turnoSelect.val() > 0) {
                window.axios
                    .get('/casa/getCasasByOcupantes/{{$idConcurso}}/' + totalOcupantes)
                    .then(function (response) {
                        // console.log(response.data)

                        $('.tp' + turno + 'casa').each(function (i, obj) {
                            console.log("element: " + obj.id)
                            $('#' + obj.id).html(null)//.trigger('change');
                            $('#' + obj.id).append(new Option('Selecione', 0, false, false))//.trigger('change');
                            $.each(response.data, function (k, v) {
                                $('#' + obj.id).append(new Option(v.DESIGNCASA + ' ' + v.RUA_AV, v.CODGRUPO, false, false))//.trigger('change');
                            });
                            $('#' + obj.id).trigger('change');
                            $('#' + obj.id).prop('disabled', false);
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .finally(function () {

                    });
            } else {
                $('.tp' + turno + 'casa').each(function (i, obj) {
                    $('#' + obj.id).html(null)
                    $('#' + obj.id).prop('disabled', true)
                });
            }

        }


    </script>

@endsection

