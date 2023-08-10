<!-- Modal -->
<div class="modal fade" id="documentacion{{ $adqui->idadquisicion }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Documentos referentes a la requisición con folio:
                    {{ $adqui->folio }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 row">
                        <div class="col-4 border border-end-0">
                            <label for="" class="form-label"><b>Investigación de referencia</b></label><br>
                            @if ($adqui->adqui_refe)
                                <a class="btn btn-sm btn-info mb-1"
                                    href="{{ asset('/documentos/referencias/' . $adqui->adqui_refe) }}" target="_blank"
                                    style="color:black;">{{ $adqui->adqui_refe }}</a>
                            @else
                                <label for="" class="form-label">No tiene investigación de referencia</label>
                            @endif
                        </div>
                        <div class="col-4 border">
                            <label for="" class="form-label"><b>Suficiencia presupuestal</b></label><br>
                            @if ($adqui->adqui_presupuesto)
                                <a class="btn btn-sm btn-info mb-1"
                                    href="{{ asset('/documentos/presupuestal/' . $adqui->adqui_presupuesto) }}"
                                    target="_blank" style="color:black;">{{ $adqui->adqui_presupuesto }}</a>
                            @else
                                <label for="" class="form-label">No tiene el documento de suficiencia
                                    presupuestal</label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
