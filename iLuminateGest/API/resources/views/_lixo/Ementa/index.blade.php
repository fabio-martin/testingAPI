@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="card mb-12">
            <div class="card-body">
                <ul>
                    <li>Aquisição de senha normal para ALMOÇO até às 11:00. Das 11:00 às 12:00 o valor da senha é acrescido da taxa suplementar de 0.50€ e será satisfeita conforme a disponibilidade da Secção de Alimentação.</li>
                    <li>Aquisição de senha normal para JANTAR até às 16:00. Das 16:00 às 18:00 o valor da senha é acrescido da taxa suplementar de 0.50€ e será satisfeita conforme a disponibilidade da Secção de Alimentação.</li>
                    <li>Menu sujeito a alterações</li>
                    <li>Os ISEL reservam-se no direito de debitar as senhas que sejam reservadas e não sejam levantadas.</li>
                </ul>
            </div>
        </div>

    </div>



    <div class="row">
        @foreach($ementas as $ementa)
{{--            {{$ementa}}--}}
            <div class="col-lg-3 col-6">
            @if($ementa->Id%2==0)
                <div class="small-box bg-light">
            @else
                <div class="small-box bg-gray-light">
            @endif
                    <div class="inner">
                        <h3>{{$ementa->Dia}}</h3>
                        <h2>Almoço</h2>
                        <p>Sopa: <strong>{{$ementa->AlmocoSopa}}</strong></p>
                        <p>Prato do dia: <strong>{{$ementa->AlmocoP}}</strong></p>
                        <p>Prato Opcional: <strong>{{$ementa->AlmocoA}}</strong></p>
                        <p>Sobremesa: <strong>{{$ementa->AlmocoS}}</strong></p>
                        <hr>
                        @if($ementa->JantarSopa!='')
                        <h2>Jantar</h2>
                        <p>Sopa: <strong>{{$ementa->JantarSopa}}</strong></p>
                        <p>Prato do dia: <strong>{{$ementa->JantarP}}</strong></p>
                        <p>Prato Opcional: <strong>{{$ementa->JantarA}}</strong></p>
                        <p>Sobremesa: <strong>{{$ementa->JantarS}}</strong></p>
                        @endif
                    </div>
                    <div class="icon">
                        <i class="fas fa-utensils"></i>
                    </div>
{{--                    <a href="/ementa/{{$ementa->Id}}" class="small-box-footer">Ver mais <i class="fas fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
        @endforeach
    </div>

            <div class="row">
                <div class="card mb-12">
                    <div class="card-body">
                        <div class="text-justify">
                            Para conhecer a ementa do dia também poderá enviar um SMS para o número 962 533 632 com o seguinte texto: matricula,Ementa ex: ({{$utilizador}},Ementa)<a class="d-lg-none d-md-none" href="sms:962533632;?&body={{$utilizador}},Ementa"> preparar sms</a>.
                        </div>
                        <div class="text-justify">
                            Para reservar senha de refeição envie um SMS para o número 962 533 632 com o seguinte texto:
                        </div>
                        <div class="text-justify">
                            <ul>
                                <li>matricula,Almoco1,nº  senhas  que  pretende ex: ({{$utilizador}},Almoco1,3)<a class="d-lg-none d-md-none" href="sms:962533632;?&body={{$utilizador}},Almoco1,3"> preparar sms</a> - válido para o prato do dia</li>
                                <li>matricula,Almoco2,nº  senhas  que  pretende ex: ({{$utilizador}},Almoco2,3)<a class="d-lg-none d-md-none" href="sms:962533632;?&body={{$utilizador}},Almoco2,3"> preparar sms</a> - válido para o prato alternativo</li>
                            </ul>
                        </div>
                        <div class="text-justify">
                            Ao usufruir deste serviço deverá ter em conta que:
                        </div>
                        <div class="text-justify">
                            <ul>
                                <li>Aquisição de senha normal para ALMOÇO até às 11:00. Das 11:00 às 12:00 o valor da senha é acrescido da taxa suplementar de 0.50€ e será satisfeita conforme a disponibilidade da Secção de Alimentação.</li>
                                <li>Aquisição de senha normal para JANTAR até às 16:00. Das 16:00 às 18:00 o valor da senha é acrescido da taxa suplementar de 0.50€ e será satisfeita conforme a disponibilidade da Secção de Alimentação.</li>
                                <li>Menu sujeito a alterações</li>
                                <li>Os ISEL reservam-se no direito de debitar as senhas que sejam reservadas e não sejam levantadas.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

@stop
