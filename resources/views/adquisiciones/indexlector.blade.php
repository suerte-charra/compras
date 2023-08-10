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
                <div class="row m-2">
                    <div class="row col-12">
                        {{-- <img src="{{ asset('img/estatus.png') }}" class="img-fluid mt-2" style="margin-left: 15px;" alt="..."> --}}
                        <label for=""><h3>Estatus de las adquisiciones</h3></label>
                        <div class="col">
                            <span style="height: 25px;width: 25px;background-color: rgb(117, 0, 0);border-radius: 50%;display: inline-block;" class="border border-dark"></span>
                            <p>No aprobada</p>
                        </div>
                        <div class="col">
                            <span style="height: 25px;width: 25px;background-color: rgb(218, 205, 205);border-radius: 50%;display: inline-block;" class="border border-dark"></span>
                            <p>Recibida</p>
                        </div>
                        <div class="col">
                            <span style="height: 25px;width: 25px;background-color: rgb(247, 239, 134);border-radius: 50%;display: inline-block;" class="border border-dark"></span>
                            <p>Aceptada</p>
                        </div>
                        <div class="col">
                            <span style="height: 25px;width: 25px;background-color: rgb(231, 195, 148);border-radius: 50%;display: inline-block;" class="border border-dark"></span>
                            <p>Aprobada</p>
                        </div>
                        <div class="col">
                            <span style="height: 25px;width: 25px;background-color: rgb(255, 157, 45);border-radius: 50%;display: inline-block;" class="border border-dark"></span>
                            <p>En espera</p>
                        </div>
                        <div class="col">
                            <span style="height: 25px;width: 25px;background-color: rgb(63, 236, 72);border-radius: 50%;display: inline-block;" class="border border-dark"></span>
                            <p>En almacen</p>
                        </div>
                        <div class="col">
                            <span style="height: 25px;width: 25px;background-color: rgb(52, 88, 245);border-radius: 50%;display: inline-block;" class="border border-dark"></span>
                            <p>Entregada</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container border">
                        {{-- <h5 class="text-center mt-2">Total de adquisiciones</h5> --}}
                        <table id="example" class="table dt-responsive nowrap border" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Fecha Ingreso</th>
                                    <th>Folio</th>
                                    <th>Dependencia</th>
                                    <th>Contenido</th>
                                    <th>Observaciones</th>
                                    <th>Documentación</th>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adquisiciones as $adquisicion)
                                <tr 
                                @if (Auth::user()->categoria <> 'admin' && Auth::user()->categoria <> 'cap')
                                    @if ($adquisicion->adquisicion_estatus == 0)
                                        style = "color:white; background:rgb(117, 0, 0);"
                                    @elseif ($adquisicion->adquisicion_estatus == 1)
                                        style = "color:black; background:rgb(218, 205, 205);"
                                    @elseif ($adquisicion->adquisicion_estatus == 2)
                                        style = "color:black; background:rgb(247, 239, 134);"
                                    @elseif ($adquisicion->adquisicion_estatus == 3)
                                        style = "color:black; background:rgb(231, 195, 148);"
                                    @elseif ($adquisicion->adquisicion_estatus == 4)
                                        style = "color:black; background:rgb(255, 157, 45);"
                                    @elseif ($adquisicion->adquisicion_estatus == 5)
                                        style = "color:black; background:rgb(63, 236, 72);"
                                    @elseif ($adquisicion->adquisicion_estatus == 6)
                                        style = "color:black; background:rgb(52, 88, 245);"
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
                                    <td>{{$adquisicion->partida ?? 'No se agrego partida presupuestal'}}</td>
                                    <td>{{$adquisicion->descripcion}}</td>
                                    <td>{{$adquisicion->clasificacion_nombre}}</td>
                                    <td>{{$adquisicion->medida_nombre}}</td>
                                    <td>{{$adquisicion->descripcionadqui}}</td>
                                    <td>{{$adquisicion->financiamiento_nombre}}</td>
                                    <td>${{number_format($adquisicion->monto,2, ',', ' ')}}</td>
                                    <td>{{$adquisicion->proveedor}}</td>
                                    <td>{{$adquisicion->fechaaprox}}</td>
                                    <td>{{$adquisicion->fechaentrega}}</td>
                                </tr>
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
@endsection
</div>
@endsection
