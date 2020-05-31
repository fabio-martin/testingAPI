@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')

    <div class="row">
        <div class="card mb-12">
            <div class="card-header"><i class="fa fa-pencil"></i> ANTES DE AVAN&Ccedil;AR, LEIA COM ATEN&Ccedil;&Atilde;O</div>
            <div class="card-body">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Todo o benefici&aacute;rio &eacute; respons&aacute;vel pelo pagamento integral das despesas e danos efectuados por si e pelas pessoas &agrave; sua responsabilidade, sob pena de incorrer em responsabilidade civil e/ou disciplinar, determinando ainda a suspens&atilde;o do direito &agrave;s presta&ccedil;&otilde;es solicitadas aos ISEL at&eacute; completo e integral pagamento das d&iacute;vidas. </p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quando indicar o seu NIB para autoriza&ccedil;&atilde;o de desconto por d&eacute;bito directo, certifique-se que o mesmo &eacute; duma conta de Dep&oacute;sitos &agrave; Ordem, v&aacute;lida e com saldo dispon&iacute;vel, e confirme esta autoriza&ccedil;&atilde;o junto do seu banco.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Certifique-se que a inscri&ccedil;&atilde;o que vai realizar corresponde efectivamente &agrave;quilo que pretende. Em caso de d&uacute;vida ou dificuldade em aceder ao Portal do benefici&aacute;rio, contacte os ISEL.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lembre-se que &eacute; poss&iacute;vel anular o seu pedido e proceder &agrave; desist&ecirc;ncia do mesmo, dentro dos prazos regulamentares.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Declaro que tomei conhecimento e aceito estas disposi&ccedil;&otilde;es e Regulamentos em vigor, dispon&iacute;veis no menu &ldquo;Documentos&rdquo;, e confirmo a veracidade destas declara&ccedil;&otilde;es.</p>
            </div>
        </div>

    </div>


    <div class="row">
        @foreach($concursos as $concurso)

            <div class="col-lg-3 col-6">
                <div class="small-box {{$concurso->icon->COLOR}}">
                    <div class="inner">
{{--                                    <h3>{{$concurso->DataInicio}}-{{$concurso->DataFim}}</h3>--}}
                        <p><b>{{$concurso->Designacao}}</b></p>
                        <p>{{$concurso->DataInicio}}-{{$concurso->DataFim}}</p>

                    </div>
                    <div class="icon">
                        <i class="fa {{$concurso->icon->ICON}}"></i>
                    </div>
                    <div class="row text-center">
                        <div class="col-4">
                            <a href="/concurso/{{$concurso->ID}}/{{strtolower($concurso->CODIGO)}}/create" type="button" class="btn  bg-gradient-secondary btn-md" data-toggle="tooltip" data-placement="right" title="Inscrever">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="/concurso/{{$concurso->ID}}/{{strtolower($concurso->CODIGO)}}"  type="button" class="btn  bg-gradient-primary btn-md" data-toggle="tooltip" data-placement="right" title="Ver inscrições">
                                <i class="fas fa-folder-open"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="documento/{{Str::substr($concurso->Regulamento, 27)}}" target="_blank" type="button" class="btn  bg-gradient-success btn-md" data-toggle="tooltip" data-placement="right" title="Ver Regulamento">
                                <i class='fa fa-file'></i>
                            </a>
                        </div>
                    </div>
                    <br>

                </div>
            </div>
        @endforeach
    </div>

@stop
