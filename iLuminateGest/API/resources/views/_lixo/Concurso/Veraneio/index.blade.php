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
                    <h3 class="card-title">Lista de Inscrições</h3>

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
                                <th>Turno 1</th>
                                <th>Casa 1</th>
                                <th>Casa 2</th>
                                <th>Casa 3</th>
                                <th>Turno 2</th>
                                <th>Casa 1</th>
                                <th>Casa 2</th>
                                <th>Casa 3</th>
                                <th>Turno 3</th>
                                <th>Casa 1</th>
                                <th>Casa 2</th>
                                <th>Casa 3</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($concursosVeraneio as $concursoVeraneio)
                                <tr id="concursoVeraneio{{$concursoVeraneio->id}}">
                                    <td>
                                        <a href="/concurso/{{$concursoVeraneio->concurso_id}}/veraneio/{{$concursoVeraneio->id}}/edit"
                                           type="button" class="btn  bg-gradient-success btn-md" data-toggle="tooltip"
                                           data-placement="right" title="Alterar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button href="#!" onclick="apagarConcursoVeraneio({{$concursoVeraneio->concurso_id}}, {{$concursoVeraneio->id}})"
                                                type="button" class="btn  bg-gradient-danger btn-md"
                                                data-toggle="tooltip" data-placement="right" title="Apagar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                    </td>
                                    <td>{{$concursoVeraneio->id}}</td>
                                    <td>{{$concursoVeraneio->TP1}}</td>
                                    <td>{{$concursoVeraneio->casaTP1CP1()->DESIGNGRUPO}}</td>
                                    <td>{{$concursoVeraneio->casaTP1CP2()->DESIGNGRUPO}}</td>
                                    <td>{{$concursoVeraneio->casaTP1CP3()->DESIGNGRUPO}}</td>
                                    <td>{{$concursoVeraneio->TP2}}</td>
                                    <td>{{$concursoVeraneio->TP2CP1}}</td>
                                    <td>{{$concursoVeraneio->TP2CP2}}</td>
                                    <td>{{$concursoVeraneio->TP2CP3}}</td>
                                    <td>{{$concursoVeraneio->TP3}}</td>
                                    <td>{{$concursoVeraneio->TP3CP1}}</td>
                                    <td>{{$concursoVeraneio->TP3CP2}}</td>
                                    <td>{{$concursoVeraneio->TP3CP3}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card-footer clearfix ">
{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            ....--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@stop



@section('js')
<script>
    function apagarConcursoVeraneio(idConcurso, idConcursoVeraneio) {
        Swal.fire({
            title: 'Tem a certeza?',
            text: "O registo será apagado!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: "Não",
        }).then((result) => {
            if (result.value) {


                window.axios
                    .delete('/concurso/'+idConcurso+'/veraneio/'+idConcursoVeraneio)
                    .then(function (response) {
                        console.log(response.data)

                        $('#concursoVeraneio'+idConcursoVeraneio).remove()

                        Swal.fire(
                            response.data.title,
                            response.data.message,
                            response.data.type
                        )

                    })
                    .catch(function (error) {
                        console.log(error);

                    })
                    .finally(function () {

                    });



            }
        })
    }
</script>

@stop
