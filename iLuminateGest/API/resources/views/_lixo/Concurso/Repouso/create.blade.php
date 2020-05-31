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



    <form role="form" method="POST" action="/concurso/{{$idConcurso}}/repouso" id="formAdicionarInscricao">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pedido</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
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
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="AGREGADO">Agregado</label>
                                    <select name="AGREGADO" id="AGREGADO" class="custom-select" onchange="getCasas()">
                                        @for ($i = 1; $i <= $lotacaoMaxima; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="ACOMP">Acomp</label>
                                    <select name="ACOMP" id="ACOMP" class="custom-select select2" onchange="getCasas()">
                                        @for ($i = 0; $i < $lotacaoMaxima; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input type="text" class="form-control" id="data" name="data" placeholder="" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="zona">Zona</label>
                                    <select name="zona" id="zona" class="custom-select select2" onchange="getCasas()">
                                        @foreach ($casas as $casa)
                                            <option value="{{$casa->CODZONA}}">{{$casa->ZONA}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="ACOMP">Acompanhantes</label>--}}
{{--                                    <button type="button" class="btn btn-block btn-primary" onclick="getCasas()">Ver Casas</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                        </div>
                    <div class="card-footer">
                        <div id="divCasas">


                        </div>
{{--                        <div class="row fa-pull-right">--}}
{{--                            <div class="col-md-12">--}}

{{--                                <button type="reset" class="btn btn-secondary">Limpar</button>--}}
{{--                                <button type="submit" class="btn btn-primary">Inscrever</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                </div>

            </div>
        </div>

    </form>

@stop


@section('js')
    <script>

        var inscricao= {
            dataInicio:null,
            dataFim:null
        };

        $(document).ready(function () {

            $('.select2').select2({
                theme: 'bootstrap4'
            })

            //Date picker
            $('#data').datepicker({
                autoclose: true,
                language: 'pt',
                format: 'yyyy-mm-dd'
            })
        })

        function setInscricaoData(data)
        {
            console.log(data)
            if(inscricao.dataInicio==null)
            {
                inscricao.dataInicio=data;
            }
            else
            {
                inscricao.dataFim=data


                Swal.fire(
                    'NICE',
                    'SUCESS',
                    'success'
                )
                //GOTO INSCRICAO SAVE
            }
        }


        function getCasas() {

            $('#divCasas').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw pull"></i>\n' + '<span class="sr-only">Loading...</span></div>');


            window.axios
                .post('/concurso/{{$idConcurso}}/repouso/disponibilidade', {
                    codZona: $('#zona').val()
                })
                .then(function (response) {
                    // console.log(response.data)
                    $('#divCasas').html(response.data)
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {

                });
        }


        // function getCasasTurno(turno) {
        //
        //     console.log('get casas para: ' + turno)
        //     var turnoSelect = $('#TP' + turno)
        //
        //     var totalAgregados = parseInt($('#AGREGADO').val())
        //     var totalAcompanhantes = parseInt($('#ACOMP').val())
        //
        //     var totalOcupantes = totalAgregados + totalAcompanhantes;
        //
        //     if (turnoSelect.val() > 0) {
        //
        //     } else {
        //         $('.tp' + turno + 'casa').each(function (i, obj) {
        //             $('#' + obj.id).html(null)
        //             $('#' + obj.id).prop('disabled', true)
        //         });
        //     }
        //
        // }


    </script>

@endsection

