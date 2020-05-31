@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')


    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <img src="{{ asset('images/logo.png') }}" class="" alt="ISEL" style="width: 50%">
{{--                    <h3 class="widget-user-username">ISEL</h3>--}}
                    <h5 class="widget-user-desc">Serviços Farmacêuticos</h5>

                </div>
                <div class="widget-user-image">
{{--                    <img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">--}}

                </div>
                <div class="card-footer" style="padding-top: 10px; !important;">
                    <div class="row">
                        <div class="col-sm-12">
                            <form target="_blank" action="https://servicosfarmaceuticos.ISEL.pt/process_login.php" method="POST">
                                <input type="hidden" name="data" value="{{$token}}" id="data">
                                <button type="submit" class="btn btn-block btn-outline-primary"><i class="fa fa-cart-plus fa-fw"></i>Continuar para Loja</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <div class="col-md-4"></div>
    </div>

    <div class="row">
        <div class="card mb-12">
            <div class="card-body">
                <ul>
                    <li>Os ISEL desenvolvem a sua atividade num espectro alargado de áreas, entre as quais se incluem os Serviços Farmacêuticos, localizados em Lisboa.</li>
                    <li>Na loja online dos Serviços Farmacêuticos poderá visualizar os produtos disponíveis, através dos menus que se encontram na parte superior da janela. Em cada categoria poderá fazer uma pesquisa por marca e por preço ou através da lupa no menu superior.</li>
                    <li>Para a iniciar o seu processo de compra introduza a quantidade do produto que pretende adquirir e clique em adicionar ao Carrinho. No final, reveja as suas compras, selecione o método de pagamento (Multibanco, MBWAY e PAYSHOP) e o envio, finalizando a encomenda assim que o desejar.</li>
                </ul>
            </div>
        </div>
    </div>

@stop
