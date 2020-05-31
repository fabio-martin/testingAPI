@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-sm-6">
            <!-- select -->
            <div class="form-group">
                <label>Categorias:</label>
{{--                <select id="selectCategorias" class="custom-select" onchange="getProtocolos()">--}}
{{--                    @foreach($categorias->unique('categoria') as $categoria)--}}
{{--                        <option value="{{$categoria->categoria}}">{{$categoria->categoria}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
            </div>
        </div>
        <div class="col-sm-6">
            <!-- select -->
            <div class="form-group">
                <label>Distrito:</label>
                <select id="selectDistritos" class="custom-select" onchange="getProtocolos()">
                    @foreach($distritos as $distrito)
                        @if($distrito=='%')
                        <option value="%">Nacional</option>
                         @else
                        <option value="{{$distrito}}">{{$distrito}}</option>

                        @endif

                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Protocolos</h3>
                </div>
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <table id="datatable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Protocolo</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>Protocolo</th>
                                <th>Opções</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>



@stop


@section('js')
    <script>
        var datatable;
        $(document).ready(function () {
            datatable = $('#datatable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Portuguese.json"
                },
                "order": [1, 'desc'],
                "responsive": true,
                //"scrollX": true,
                //"bScrollCollapse": true,
                //"bRetrieve": true,
                //"sPaginationType": "full_numbers",
                //"aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Todas"]],
                //"iDisplayLength": 50,
                "processing": true,
                "serverSide": false,
                "ajax": "/protocolo/getProtocolosDatatables/" + getSelectCategoria() + '/' + getSelectDistrito(),
                {{--                ajax: {--}}
                    {{--                    url: "{{ route('getProtocolosDatatables') }}",--}}
                    {{--                    data: {categoria: $('#selectCategorias').val()},--}}
                    {{--                },--}}
                "columns": [
                    {data: 'image'},
                    {data: 'titulo'},
                    {data: 'opcoes'}
                ],
                // "aoColumnDefs": [
                //     {
                //         "targets": [ 3 ], "visible": false
                //     }
                // ],
            });
        })


        function getProtocolos() {
            // datatable.ajax.reload(null, false);
            datatable.ajax.url('/protocolo/getProtocolosDatatables/' + getSelectCategoria() + '/' + getSelectDistrito()).load()
        }

        function getSelectCategoria() {
            return $('#selectCategorias').val();
        }
        function getSelectDistrito() {
            return $('#selectDistritos').val();
        }
    </script>

@endsection

