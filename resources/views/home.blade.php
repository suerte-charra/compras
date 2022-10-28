@extends('layouts.principal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{-- {{ __('Dashboard') }} --}}
                    <h4>Formatos de decarga</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- {{ __('You are logged in!') }} --}}
                    {{-- <div class="row">
                        <div class="col-sm-4 text-center">
                            <a href="documentos/formatos/05clasificador-objeto14.pdf" target="_blank">Clasificador por objeto del gasto</a>
                        </div>
                        <div class="col-sm-4 text-center">
                            <a href="documentos/formatos/LCPPEG_21Jul2022.pdf" target="_blank">Ley de contrataciones públicas para el estado de Guanjauto</a>
                        </div>
                        <div class="col-sm-4 text-center">
                            <a href="documentos/formatos/reglamento_de_contrataciones_publicas_para_el_municipio_de_salamanca.pdf" target="_blank">Reglamento de contrataciones públicas para el municipio de Salamanca, Gto.</a>
                        </div>
                    </div><br> --}}
                    @if (Auth::user()->user_estatus == 1)
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">DRM.01 Envío de Expedientes</h5>
                                    <a href="documentos/formatos/DRM.01 Envio de Expedientes.pdf" target="_blank" class="btn btn-primary btn-sm">Descargar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">DRM.02 Requisición</h5>
                                    <a href="documentos/formatos/DRM.02 Requisicion.pdf" target="_blank" class="btn btn-primary btn-sm">Descargar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">DRM.03 Anexo Técnico de DTIC</h5>
                                    <a href="documentos/formatos/DRM.3 Anexo Tecnico de DTIC.pdf" target="_blank" class="btn btn-primary btn-sm">Descargar</a>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">DRM.04 Suficiencia Presupuestal</h5>
                                    <a href="documentos/formatos/DRM.04 Suficiencia Presupuestal.pdf" target="_blank" class="btn btn-primary btn-sm">Descargar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">DRM.05 Análisis e Investigación de Mercado</h5>
                                    <a href="documentos/formatos/DRM.05 Analisis e Investigacion de Mercado.pdf" target="_blank" class="btn btn-primary btn-sm">Descargar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">DRM.06 Anexo Técnico</h5>
                                    <a href="documentos/formatos/DRM.06 Anexo Tecnico.pdf" target="_blank" class="btn btn-primary btn-sm">Descargar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->categoria=='admin' || Auth::user()->categoria=='director')
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">DRM.07 Pedido y Contrato</h5>
                                    <a href="documentos/formatos/DRM.07 Pedido y Contrato.pdf" target="_blank" class="btn btn-primary btn-sm">Descargar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">DRM.08 Acta Entrega Recepción</h5>
                                    <a href="documentos/formatos/DRM.08 Acta Entrega_Recepcion.pdf" target="_blank" class="btn btn-primary btn-sm">Descargar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Clasificador por objeto del gasto</h5><br><br>
                                    <a href="documentos/formatos/05clasificador-objeto14.pdf" target="_blank" class="btn btn-success btn-sm">Ver</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Ley de contrataciones públicas para el estado de Guanjauto</h5><br>
                                    <a href="documentos/formatos/LCPPEG_21Jul2022.pdf" target="_blank" class="btn btn-success btn-sm">Ver</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Reglamento de contrataciones públicas para el municipio de Salamanca, Gto.</h5>
                                    <a href="documentos/formatos/reglamento_de_contrataciones_publicas_para_el_municipio_de_salamanca.pdf" target="_blank" class="btn btn-success btn-sm">Ver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Usuario actualmente dado de baja, favor de ponerse en contacto con el administrador</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
