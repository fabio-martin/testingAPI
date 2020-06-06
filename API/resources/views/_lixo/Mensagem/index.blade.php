@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">{{$titulo}}</h1>
@stop

@section('content')


    <div class="row">
        <div class="col-md-3">
            <a href="compose.html" class="btn btn-primary btn-block mb-3">Compose</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pastas</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="/mensagem/" class="nav-link">
                                <i class="fas fa-inbox"></i> Lidas
                                <span class="badge bg-primary float-right">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-envelope"></i> Não Lidas
                                <span class="badge bg-warning float-right">5</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Inbox</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Search Mail">
                            <div class="input-group-append">
                                <div class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
                        <div class="float-right">
                            1-50/200
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                            </div>
                            <!-- /.btn-group -->
                        </div>
                        <!-- /.float-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                            @foreach($mensagens as $mensagem)
                                <tr>
                                    <td class="mailbox-name"><a href="/mensagem/{{$mensagem->id}}">{{$mensagem->de}}</a></td>
                                    <td class="mailbox-subject">{{$mensagem->assunto}}
                                    </td>
                                    <td class="mailbox-date">{{$mensagem->CriadoEm}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer p-0">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
                        <div class="float-right">
                            1-50/200
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                            </div>
                            <!-- /.btn-group -->
                        </div>
                        <!-- /.float-right -->
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
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
                "ajax": "/documento/getDocumentsDatatables/" + getSelectCategoria(),
                {{--                ajax: {--}}
                    {{--                    url: "{{ route('getDocumentsDatatables') }}",--}}
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


        function getDocuments() {
            // datatable.ajax.reload(null, false);
            datatable.ajax.url('/documento/getDocumentsDatatables/' + getSelectCategoria()).load()
        }

        function getSelectCategoria() {
            return $('#selectCategorias').val();
        }


    </script>

@endsection

