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
                    <h4>Catálogo de Proveedores</h4>
                    <div class="row">
                        <div class="col align-self-end text-end">
                            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#agregar">Agregar</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <label>{{ $error }}</label>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="container border">
                        <h5 class="text-center mt-2">Proveedores activos</h5>
                        <table id="example" class="table table-striped dt-responsive nowrap border" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Rfc</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Dirección</th>
                                    <th>Correo</th>
                                    <th>Giro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proveedores as $proveedor)
                                <tr>
                                    <td>{{$proveedor->idproveedor}}</td>
                                    <td>{{$proveedor->rfc}}</td>
                                    <td>{{$proveedor->nombre_comercial}}</td>
                                    <td>{{$proveedor->telefono}}</td>
                                    <td>{{$proveedor->direccion}}</td>
                                    <td>{{$proveedor->correo}}</td>
                                    <td>{{$proveedor->giro}}</td>
                                    <td>
                                        <a href="{{route('bajaproveedor',$proveedor->idproveedor)}}" class="btn btn-danger btn-sm" onclick="return confirm ('¿Estás seguro de dar de baja este proveedor?')">Desactivar</a>
                                    </td>
                                </tr>
                                {{-- @include('dependencias.modales.modaleditar') --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div><br>
                    <div class="container border">
                        <h5 class="text-center mt-2">Proveedores inactivos</h5>
                        <table id="example_1" class="table table-striped dt-responsive nowrap border" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Rfc</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Correo</th>
                                    <th>Giro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proveedores_1 as $proveedor_1)
                                <tr>
                                    <td>{{$proveedor_1->idproveedor}}</td>
                                    <td>{{$proveedor_1->rfc}}</td>
                                    <td>{{$proveedor_1->nombre_comercial}}</td>
                                    <td>{{$proveedor_1->telefono}}</td>
                                    <td>{{$proveedor_1->direccion}}</td>
                                    <td>{{$proveedor_1->correo}}</td>
                                    <td>{{$proveedor_1->giro}}</td>
                                    <td>
                                        <a href="{{route('bajaproveedor',$proveedor_1->idproveedor)}}" class="btn btn-success btn-sm" onclick="return confirm ('¿Estás seguro de activar este proveedor?')">Activar</a>
                                    </td>
                                </tr>
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
    <script>
        $(document).ready(function () {
            $('#example_1').DataTable({
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Agregar proveedor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('agregarproveedor')}}" method="POST">
                
            @csrf
            <div class="row border">
                <div class="col-md-4 mt-2">
                    <label for="" class="form-label">Nombre comercial<b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="ncomercial" id="ncomercial">
                </div>
                <div class="col-md-4 mt-2">
                    <label for="" class="form-label">Rfc<b class="text-danger">*</b></label>
                    <input type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" id="rfc" minlength="13" maxlength="14" required>
                    @error('rfc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-2 mt-2">
                    <label for="" class="form-label">Dirección<b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="direccion" id="direccion">
                </div>
            </div>
            <br>
            <div class="row border">
                <div class="col-md-4 mt-2">
                    <label for="" class="form-label">Correo<b class="text-danger">*</b></label>
                    <input type="email" class="form-control" name="correo" id="correo">
                </div>
                <div class="col-md-4 mt-2">
                    <label for="" class="form-label">Giro<b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="giro" id="giro">
                </div>
                <div class="col-md-4 mb-2 mt-2">
                    <label for="" class="form-label">Nombre<b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                </div>
            </div>
            <br>
            <div class="row border">
                <div class="col-md-6 mt-2">
                    <label for="">Número(s) de telefono</label>
                    <textarea name="telefono" id="telefono" cols="50" rows="5" style="resize:none"></textarea>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary mt-2" onclick="return confirm('¿Desea guardar este nuevo proveedor?')">Guardar</button>
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
