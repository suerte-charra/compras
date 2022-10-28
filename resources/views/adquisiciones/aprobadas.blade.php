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
                    <h4>Lista de adquisiciones</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container border">
                        <h5 class="text-center mt-2">Adquisiciones Aprobadas</h5>
                        <table id="example" class="table table-striped dt-responsive nowrap border" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Fecha Ingreso</th>
                                    <th>Folio</th>
                                    <th>Dependencia</th>
                                    <th>Observaciones</th>
                                    <th>Documento DRM02</th>
                                    <th>Investigación</th>
                                    <th>Resp. Requisitoria</th>
                                    <th>Partida Presupuestal</th>
                                    <th>Descripción General</th>
                                    <th>Clasificación</th>
                                    <th>Unidad de Medida</th>
                                    <th>Desc. Adquisición</th>
                                    <th>Fuentes de Financiamiento</th>
                                    <th>Monto</th>
                                    <th>Proveedor</th>
                                    <th>Fecha de Adquisición</th>
                                    <th>Fecha Entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adquisicionesaprobadas as $adquisicionesaprobada)
                                <tr 
                                @if (Auth::user()->categoria <> 'admin' && Auth::user()->categoria <> 'cap')
                                    @if ($adquisicionesaprobada->adquisicion_estatus == 2)
                                        style = "color:black;background:#7BCB62;"
                                    @elseif ($adquisicionesaprobada->adquisicion_estatus == 1)
                                        style = "color:black;background:#BACDB4;"
                                    @elseif ($adquisicionesaprobada->adquisicion_estatus == 0)
                                        style = "color:black;background:#CB6262;"
                                     @endif  
                                @endif
                               >
                                    <td>{{$adquisicionesaprobada->fechaadqui}}</td>
                                    <td>{{$adquisicionesaprobada->folio}}</td>
                                    <td>{{$adquisicionesaprobada->dependencia_nombre}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#observaciones{{$adquisicionesaprobada->idadquisicion}}">Ver observaciones</button>
                                    </td>
                                    <td>
                                        @if($adquisicionesaprobada->documento)
                                            <a href="{{asset('/documentos/documentospresentados/'.$adquisicionesaprobada->documento)}}" target="_blank" style="color:black;">{{$adquisicionesaprobada->documento}}</a>
                                        @else
                                            No tiene documento
                                        @endif
                                    </td>
                                    <td>
                                        @if($adquisicionesaprobada->investigacion)
                                            <a href="{{asset('/documentos/investigaciondemercado/'.$adquisicionesaprobada->investigacion)}}" target="_blank" style="color:black;">{{$adquisicionesaprobada->investigacion}}</a>
                                        @else
                                            No tiene investigación de mercado
                                        @endif
                                    </td>
                                    <td>
                                        @if($adquisicionesaprobada->resrequi)
                                            <a href="{{asset('/documentos/respuestarequisitoria/'.$adquisicionesaprobada->resrequi)}}" target="_blank" style="color:black;">{{$adquisicionesaprobada->resrequi}}</a>
                                        @else
                                            No tiene respuesta requisitoria
                                        @endif
                                    </td>
                                    <td>{{$adquisicionesaprobada->partida ?? 'No se agrego partida presupuestal'}}</td>
                                    <td>{{$adquisicionesaprobada->descripcion}}</td>
                                    <td>{{$adquisicionesaprobada->clasificacion_nombre}}</td>
                                    <td>{{$adquisicionesaprobada->medida_nombre}}</td>
                                    <td>{{$adquisicionesaprobada->descripcionadqui}}</td>
                                    <td>{{$adquisicionesaprobada->financiamiento_nombre}}</td>
                                    <td>${{number_format($adquisicionesaprobada->monto,2, ',', ' ')}}</td>
                                    <td>{{$adquisicionesaprobada->proveedor}}</td>
                                    <td>{{$adquisicionesaprobada->fechaaprox}}</td>
                                    <td>{{$adquisicionesaprobada->fechaentrega}}</td>
                                </tr>
                                @include('adquisiciones.modales.modalobservacionesaprobadas')
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
@endsection
</div>
@endsection