@extends('layouts.principal')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
    <style>
        .toast-success {
            background-color: #51a351 !important;
        }

        .toast-error {
            background-color: #be5252 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Requisiciones encontradas</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <table id="example" class="table table-striped dt-responsive nowrap border" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Fecha Ingreso</th>
                                <th>Folio</th>
                                <th>Partida Presupuestal</th>
                                <th>Dependencia</th>
                                <th>Contenido</th>
                                <th>Observaciones</th>
                                <th>Documentación</th>
                                <th>Monto</th>
                                <th>Proveedor</th>
                                <th>Fecha de Adjudicación</th>
                                <th>Fecha Entrega</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adquis as $adqui)
                                <tr>
                                    <td>{{ $adqui->fechaadqui }}</td>
                                    <td>{{ $adqui->folio }}</td>
                                    <td>{{ $adqui->partida }}</td>
                                    <td>{{ $adqui->dependencia_nombre }}</td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#contenido{{ $adqui->idadquisicion }}">
                                            <i class="fa-regular fa-folder-closed"></i> Contenido
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#observaciones{{ $adqui->idadquisicion }}"><i
                                                class="fa-regular fa-eye"></i>
                                            Observaciones</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#documentacion{{ $adqui->idadquisicion }}"><i
                                                class="fa-regular fa-file"></i> Documentos</button>
                                    </td>
                                    <td>{{ $adqui->monto ?? 'SIN ASIGNAR' }}</td>
                                    <td>{{ $adqui->nombre_comercial ?? 'SIN ASIGNAR' }}</td>
                                    <td>{{ $adqui->fechaaprox ?? 'SIN ASIGNAR' }}</td>
                                    <td>{{ $adqui->fechaentrega ?? 'SIN ASIGNAR' }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editar{{ $adqui->idadquisicion }}">Editar</button>
                                    </td>
                                </tr>
                                @include('adquisiciones.busquedas.modales.contenido')
                                @include('adquisiciones.busquedas.modales.documentos')
                                @include('adquisiciones.busquedas.modales.observaciones')
                                @include('adquisiciones.busquedas.modales.editar')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 8000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                scrollX: true,
                "lengthMenu": [
                    [15, 20, 50, -1],
                    [15, 20, 50, "Todos"]
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        });
    </script>
@endsection
