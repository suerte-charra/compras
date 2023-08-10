@extends('layouts.principal')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">

    <style>
        .toast-success{
            background-color: #51a351 !important;
        }
        .toast-error{
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
                    <h4>Lista de adquisiciones para almacen</h4>                    
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container border">
                        <h5 class="text-center mt-2">Adquisiciones
                            @if ($tipo == 5)
                                en almancen
                            @elseif($tipo == 6)
                                entregadas
                            @endif
                        </h5>
                        <table id="example" class="table table-striped dt-responsive nowrap border" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Fecha Ingreso</th>
                                    <th>Folio</th>
                                    <th>Dependencia</th>
                                    <th>Contenido</th>
                                    <th>Observaciones</th>
                                    <th>Documentación</th>
                                    <th>Estatus</th>
                                    <th>Partida Presupuestal</th>
                                    <th>Descripción General</th>
                                    <th>Clasificación</th>
                                    <th>Unidad de Medida</th>
                                    <th>Desc. Adquisición</th>
                                    <th>Fuentes de Financiamiento</th>
                                    <th>Monto</th>
                                    <th>Proveedor</th>
                                    <th>Fecha de Adjudicación</th>
                                    <th>Fecha Entrega</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adquisiciones as $adquisicion)
                                <tr 
                                @if (Auth::user()->categoria <> 'admin' && Auth::user()->categoria <> 'cap')
                                    @if ($adquisicion->adquisicion_estatus == 2)
                                        style = "color:black;background:#7BCB62;"
                                    @elseif ($adquisicion->adquisicion_estatus == 1)
                                        style = "color:black;background:#FFFFFF;"
                                    @elseif ($adquisicion->adquisicion_estatus == 0)
                                        style = "color:black;background:#CB6262;"
                                    @endif  
                                @endif
                                >
                                    <td>{{$adquisicion->fechaadqui}}</td>
                                    <td>{{$adquisicion->folio}}</td>
                                    <td>{{$adquisicion->dependencia_nombre}}</td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#contenido{{$adquisicion->idadquisicion}}"><i class="fa-regular fa-folder-closed"></i> Contenido</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#observaciones{{$adquisicion->idadquisicion}}"><i class="fa-regular fa-eye"></i> Observaciones</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#documentacion{{$adquisicion->idadquisicion}}"><i class="fa-regular fa-file"></i> Documentos</button>
                                    </td>
                                    <td>
                                        @if ($adquisicion->adquisicion_estatus == 4)
                                            A LA ESPERA DEL PROVEEDOR
                                        @elseif($adquisicion->adquisicion_estatus == 5)
                                            EN EL ALMANCEN
                                        @elseif($adquisicion->adquisicion_estatus == 6)
                                            ENTREGADO
                                        @else
                                            ERROR
                                        @endif
                                    </td>
                                    <td>{{$adquisicion->partida ?? 'No se agrego partida presupuestal'}}</td>
                                    <td>{{$adquisicion->descripcion}}</td>
                                    <td>{{$adquisicion->clasificacion_nombre}}</td>
                                    <td>{{$adquisicion->medida_nombre}}</td>
                                    <td>{{$adquisicion->descripcionadqui}}</td>
                                    <td>{{$adquisicion->financiamiento_nombre}}</td>
                                    <td>${{number_format($adquisicion->monto,2, '.', ',')}}</td>
                                    <td>{{$adquisicion->nombre_comercial ?? 'No hay proveedor'}}</td>
                                    <td>{{$adquisicion->fechaaprox}}</td>
                                    <td>{{$adquisicion->fechaentrega}}</td>
                                    <td>
                                        @if (Auth::user()->categoria == 'almacen' && $tipo != 6)
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editar{{$adquisicion->idadquisicion}}">Editar</button>    
                                        @else
                                            NO ACCIONES QUE REALIZAR
                                        @endif
                                        
                                    </td>
                                </tr>
                                @include('adquisiciones.modales.modaleditaralmacen')
                                @include('adquisiciones.modales.modalobservaciones')
                                @include('adquisiciones.modales.modaldocumentacion')
                                @include('adquisiciones.modales.modalcontenido')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 8000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                scrollX: true,
                "lengthMenu": [[15,20,50,-1],[15,20,50,"Todos"]],
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
    {{-- <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script> --}}
@endsection
</div>
@endsection