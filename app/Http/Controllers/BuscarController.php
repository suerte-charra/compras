<?php

namespace App\Http\Controllers;

use App\Models\Adquisicion;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BuscarController extends Controller
{
    //
    public function buscar()
    {
        return view('adquisiciones.busquedas.busqueda');
    }
    public function buscarFolio(Request $request)
    {
        $adquis = Adquisicion::where('folio', 'LIKE', '%' . $request->bfolio . '%')
            ->join('dependencias', 'iddependencia', 'cat_dep')
            ->leftJoin('proveedors', 'idproveedor', 'proveedor')
            ->select(
                'idadquisicion',
                'fechaadqui',
                'folio',
                'adqui_refe',
                'adqui_presupuesto',
                'partida',
                'dependencia_nombre',
                'observaciones',
                'fechaaprox',
                'fechaentrega',
                'proveedor',
                'adqui_contenido',
                'monto',
                'idproveedor',
                'nombre_comercial',
                'adquisicion_estatus'
            )
            ->get();
        $proveedores = Proveedor::all();
        
        //dd($adquis);
        return view('adquisiciones.busquedas.resultado', compact('adquis', 'proveedores'));
    }

    public function actualizarFolio($folio, Request $request)
    {
        $adqui = Adquisicion::find($folio);
        if ($request->proveedor_1) {
            $prove = explode("-", $request->proveedor_1);
            $adqui->proveedor = $prove[0];
        }
        if ($request->monto_1) {
            $adqui->monto = $request->monto_1;
        }
        if ($request->faprox_1) {
            $adqui->fechaaprox  = $request->faprox_1;
        }
        if ($request->fentrega_1) {
            $adqui->fechaentrega = $request->fentrega_1;
        }
        if ($request->dgeneral_1) {
            $adqui->descripcion  = $request->dgeneral_1;
        }
        if ($request->dadquisicion_1) {
            $adqui->descripcionadqui = $request->dadquisicion_1;
        }
        if($adqui->observaciones){
            $adqui->observaciones = $adqui->observaciones."\n".$request->observaciones_1.' con fecha:'.date("d/m/Y h:i:s A", strtotime(' -1 hours'));
        }else{
            $adqui->observaciones = $request->observaciones_1.' con fecha:'.date("d/m/Y h:i:s A", strtotime(' -1 hours'));
        }
        if($request->estatus_adqui != '10'){
            $adqui->adquisicion_estatus = $request->estatus_adqui;
        }
        //dd($adqui);
        $adqui->save();
        return redirect()->route('buscar')->with('success', 'Adquisición actualizada exitosamente!');
        
    }
}
