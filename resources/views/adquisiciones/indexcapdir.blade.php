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
                    @if (Auth::user()->categoria == 'cap')
                        <div class="col align-self-end text-end">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregar">Agregar Adquisión</button>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12">
                        <img src="{{ asset('img/estatus.png') }}" class="img-fluid mt-2" style="margin-left: 15px;" alt="...">
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container border">
                        <h5 class="text-center mt-2">Total de adquisiciones</h5>
                        <table id="example" class="table dt-responsive nowrap border" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Fecha Ingreso</th>
                                    <th>Folio</th>
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
                                    <th>Fecha de Adquisición</th>
                                    <th>Fecha Entrega</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($adquisiciones as $adquisicion)
                                <tr 
                                @if (Auth::user()->categoria <> 'admin')
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
                                    <td>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#accion{{$adquisicion->idadquisicion}}"><i class="fa-regular fa-pen-to-square"></i> Observación</button>
                                    </td>
                                </tr>
                                @include('adquisiciones.modales.modalobservaciones')
                                @include('adquisiciones.modales.modaldocumentacion')
                                @include('adquisiciones.modales.modalcontenido')
                                @include('adquisiciones.modales.modalaccion')
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
    <!-- Modal -->
    <div class="modal fade" id="agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Agregar adquisición</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{route('ingresoadqui')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <label for="" class="form-lable">Fecha de ingreso</label>
                        <input type="text" name="fingreso" id="fingreso" class="form-control @error('fingreso') is-invalid @enderror" value="{{$fecha}}" readonly>
                    </div>
                    <div class="col-3">
                        <label for="" class="form-lable">Folio</label>
                        <input type="text" name="folio" id="folio" minlength="5" maxlength="5" pattern="[0-9]{5,5}" class="form-control @error('folio') is-invalid @enderror" value="{{ old('folio') }}" required>
                    </div>
                    <div class="col-6"> 
                        <label for="" class="form-lable">Unidad presupuestaria responsable</label>
                        <input type="text" class="form-control @error('dependencia') is-invalid @enderror" value="{{ $dependencia->dependencia_nombre }}" required readonly>
                        <input type="text" name="dependencia" id="dependencia" class="form-control @error('dependencia') is-invalid @enderror" value="{{ $dependencia->iddependencia }}" required hidden>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Partida presupuestal</label>
                        <input type="text" name="ppresupuestal" id="ppresupuestal" class="form-control @error('ppresupuestal') is-invalid @enderror" required>
                    </div>
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Número requisición</label>
                        <input type="text" name="nrequisicion" id="nrequisicion" class="form-control @error('nrequisicion') is-invalid @enderror" required>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Investigación referencia</label>
                        <input type="file" name="ireferencia" id="ireferencia" accept=".pdf" class="form-control @error('ireferencia') is-invalid @enderror" required>
                        @error('ireferencia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-6 mt-2">
                        <label for="" class="form-lable">Suficiencia presupuestal</label>
                        <input type="file" name="spresupuestal" id="spresupuestal" accept=".pdf" class="form-control @error('spresupuestal') is-invalid @enderror" required>
                        @error('spresupuestal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12 mt-2 border">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Partida</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="partida" id="partida" class="form-control" required></td>
                                <td><input type="text" name="cantidad" id="cantidad" class="form-control" required></td>
                                <td><input type="text" name="unidad" id="unidad" class="form-control" required></td>
                                <td><input type="text" name="des" id="des" class="form-control" required></td>
                            </tr>
                            @for($i=0; $i<3; $i++)
                            <tr>
                                <td><input type="text" name="partida{{$i}}" id="partida{{$i}}" class="form-control"></td>
                                <td><input type="text" name="cantidad{{$i}}" id="cantidad{{$i}}" class="form-control"></td>
                                <td><input type="text" name="unidad{{$i}}" id="unidad{{$i}}" class="form-control"></td>
                                <td><input type="text" name="des{{$i}}" id="des{{$i}}" class="form-control"></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('¿Desea guardar esta nueva adquisición?')">Guardar</button>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
