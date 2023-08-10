@extends('layouts.principal')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
    <style>
        .toast-success {
            background-color: #51a351 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <h4>Seccion de presupuestos totales:</h4>
                        <div class="col-4">
                            <input type="text" id="tdependencias" name="tdependencias" value="{{ count($dependencias) }} Dependencias registradas"
                                readonly class="form-control">
                            <br>
                        </div>
                        <div class="col-4">
                            <form action="/presupuestos/importar" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="csv_file" class="form-control" required>
                                <button type="submit" class="btn btn-sm mt-2" style="background-color: #20a05a; color:white">Importar
                                    presupuestos</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table id="example" class="table table-striped dt-responsive nowrap border" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Presupuesto total</th>
                                    <th>Presupuesto ejercido</th>
                                    <th>Presupuesto comprometido</th>
                                    <th>Presupuesto restante</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dependencias as $dependencia)
                                    <tr>
                                        <td>{{ $dependencia->dependencia_nombre }}</td>
                                        <td>$
                                            {{ number_format($dependencia->pre_total, 2, '.', ',') }}
                                        </td>
                                        <td>$
                                            @foreach ($pre_ejer as $ejercido)
                                                @if ($ejercido->iddependencia == $dependencia->iddependencia)
                                                    {{ number_format($ejercido->gasto, 2, '.', ',') }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>$
                                            @foreach ($pre_com as $comprometido)
                                                @if ($comprometido->iddependencia == $dependencia->iddependencia)
                                                    {{ number_format($comprometido->gasto, 2, '.', ',') }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>$
                                            @foreach ($pre_usado as $queda)
                                                @if ($queda->iddependencia == $dependencia->iddependencia)
                                                    {{ number_format($queda->restante, 2, '.', ',') }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        <script>
            $(document).ready(function() {
                var tdepe = document.getElementById('tdependencias').value;
                // var total;
                // console.log(tdepe)
                // for (var index = 1; index <= tdepe; index++) {
                //     console.log(index);
                //     total = document.getElementById('total' + index).value;
                //     console.log(total);

                // }
            });
        </script>
    @endsection
</div>
@endsection
