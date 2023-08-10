<?php

namespace App\Http\Controllers;

use App\Models\Adquisicion;
use App\Models\Clasificacion;
use App\Models\Dependencia;
use App\Models\Financiamiento;
use App\Models\Medida;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdquisicionController extends Controller
{
    public function index(){
        $fecha = date("d/m/Y");
        $clasificaciones = Clasificacion::where('clasificacion_estatus',1)->get();
        $dependencias = Dependencia::where('dependencia_estatus',1)->get();
        $financiamientos = Financiamiento::where('financimiento_estatus',1)->get();
        $medidas = Medida::where('medida_estatus',1)->get();
        if(Auth::user()->categoria == 'admin' || Auth::user()->categoria == 'compras'){
            $adquisiciones = DB::table('adquisicions')
            ->join('dependencias','adquisicions.cat_dep','dependencias.iddependencia')
            ->leftJoin('clasificacions','adquisicions.cat_clas','=','clasificacions.idclasificacion')
            ->leftJoin('medidas','adquisicions.cat_med','=','medidas.idmedida')
            ->leftJoin('financiamientos','adquisicions.cat_fin','=','financiamientos.idfinanciamiento')
            ->leftJoin('proveedors','adquisicions.proveedor','=','proveedors.idproveedor')
            ->select('adquisicions.*','dependencias.dependencia_nombre','clasificacions.clasificacion_nombre','medidas.medida_nombre',
            'financiamientos.financiamiento_nombre','proveedors.idproveedor','proveedors.nombre_comercial')
            // ->where('dependencia_estatus',1)
            //->where('clasificacion_estatus',1)
            // ->where('financimiento_estatus',1)
            // ->where('medida_estatus',1)
            ->where('adquisicion_estatus',1)
            ->get();
            //dd($adquisiciones);
            $proveedores = Proveedor::all();
        return view('adquisiciones.index',compact('clasificaciones','dependencias','financiamientos','medidas','adquisiciones','fecha','proveedores'));
        }elseif(Auth::user()->categoria == 'lector'){
            $adquisiciones = DB::table('adquisicions')
            ->join('dependencias','adquisicions.cat_dep','dependencias.iddependencia')
            ->leftJoin('clasificacions','adquisicions.cat_clas','=','clasificacions.idclasificacion')
            ->leftJoin('medidas','adquisicions.cat_med','=','medidas.idmedida')
            ->leftJoin('financiamientos','adquisicions.cat_fin','=','financiamientos.idfinanciamiento')
            ->select('adquisicions.*','dependencias.dependencia_nombre','clasificacions.clasificacion_nombre','medidas.medida_nombre','financiamientos.financiamiento_nombre')
            // ->where('dependencia_estatus',1)
            //->where('clasificacion_estatus',1)
            // ->where('financimiento_estatus',1)
            // ->where('medida_estatus',1)
            // ->where('adquisicion_estatus',4)
            ->get();
            return view('adquisiciones.indexlector',compact('adquisiciones'));
        }else{
            $adquisiciones = DB::table('adquisicions')
            ->join('dependencias','adquisicions.cat_dep','dependencias.iddependencia')
            ->leftJoin('clasificacions','adquisicions.cat_clas','=','clasificacions.idclasificacion')
            ->leftJoin('medidas','adquisicions.cat_med','=','medidas.idmedida')
            ->leftJoin('financiamientos','adquisicions.cat_fin','=','financiamientos.idfinanciamiento')
            ->select('adquisicions.*','dependencias.dependencia_nombre','clasificacions.clasificacion_nombre','medidas.medida_nombre','financiamientos.financiamiento_nombre')
            // ->where('dependencia_estatus',1)
            //->where('clasificacion_estatus',1)
            // ->where('financimiento_estatus',1)
            // ->where('medida_estatus',1)
            ->where('adquisicions.cat_dep',Auth::user()->user_iddependencia)
            ->get();
            $dependencia = Dependencia::where('iddependencia',Auth::user()->user_iddependencia)->first();
            //
            return view('adquisiciones.indexcapdir',compact('adquisiciones','clasificaciones','dependencia','financiamientos','medidas','adquisiciones','fecha'));
        }
    }

    public function indexaprobadas(){
        $clasificaciones = Clasificacion::where('clasificacion_estatus',1)->get();
        $dependencias = Dependencia::where('dependencia_estatus',1)->get();
        $financiamientos = Financiamiento::where('financimiento_estatus',1)->get();
        $medidas = Medida::where('medida_estatus',1)->get();
        $proveedores = Proveedor::all();
        $adquisicionesaprobadas = DB::table('adquisicions')
            ->join('dependencias','adquisicions.cat_dep','dependencias.iddependencia')
            ->leftJoin('clasificacions','adquisicions.cat_clas','=','clasificacions.idclasificacion')
            ->leftJoin('medidas','adquisicions.cat_med','=','medidas.idmedida')
            ->leftJoin('financiamientos','adquisicions.cat_fin','=','financiamientos.idfinanciamiento')
            ->leftJoin('proveedors','adquisicions.proveedor','=','proveedors.idproveedor')
            ->select('adquisicions.*','dependencias.dependencia_nombre','clasificacions.clasificacion_nombre','medidas.medida_nombre',
            'financiamientos.financiamiento_nombre','proveedors.nombre_comercial','proveedors.idproveedor')
            ->where('adquisicion_estatus',3)
            ->get();
        //dd($adquisicionesaprobadas);
        $tipo = 3;
        return view('adquisiciones.aprobadas',compact('adquisicionesaprobadas', 'clasificaciones','medidas','financiamientos', 'proveedores','tipo'));
    }

    public function indexaceptadas(){
        $clasificaciones = Clasificacion::where('clasificacion_estatus',1)->get();
        $dependencias = Dependencia::where('dependencia_estatus',1)->get();
        $financiamientos = Financiamiento::where('financimiento_estatus',1)->get();
        $medidas = Medida::where('medida_estatus',1)->get();
        $proveedores = Proveedor::all();
        $adquisicionesaprobadas = DB::table('adquisicions')
            ->join('dependencias','adquisicions.cat_dep','dependencias.iddependencia')
            ->leftJoin('clasificacions','adquisicions.cat_clas','=','clasificacions.idclasificacion')
            ->leftJoin('medidas','adquisicions.cat_med','=','medidas.idmedida')
            ->leftJoin('financiamientos','adquisicions.cat_fin','=','financiamientos.idfinanciamiento')
            ->leftJoin('proveedors','adquisicions.proveedor','=','proveedors.idproveedor')
            ->select('adquisicions.*','dependencias.dependencia_nombre','clasificacions.clasificacion_nombre','medidas.medida_nombre',
            'financiamientos.financiamiento_nombre','proveedors.nombre_comercial','proveedors.idproveedor')
            ->where('adquisicion_estatus',2)
            ->get();
        //dd($adquisicionesaprobadas);
        $tipo = 2;
        return view('adquisiciones.aprobadas',compact('adquisicionesaprobadas', 'clasificaciones','medidas','financiamientos', 'proveedores','tipo'));
    }

    public function indexrechazadas(){
        $adquisicionesrechazadas = DB::table('adquisicions')
            ->join('dependencias','adquisicions.cat_dep','dependencias.iddependencia')
            ->leftJoin('clasificacions','adquisicions.cat_clas','=','clasificacions.idclasificacion')
            ->leftJoin('medidas','adquisicions.cat_med','=','medidas.idmedida')
            ->leftJoin('financiamientos','adquisicions.cat_fin','=','financiamientos.idfinanciamiento')
            ->select('adquisicions.*','dependencias.dependencia_nombre','clasificacions.clasificacion_nombre','medidas.medida_nombre','financiamientos.financiamiento_nombre')
            ->where('adquisicion_estatus',0)
            ->get();
            return view('adquisiciones.rechazadas',compact('adquisicionesrechazadas'));
    }

    public function agregaradquisicion(Request $request){
         //dd($request);
        
        //dd($request);
        $cadena = '';
        for ($i=0; $i < 9; $i++) { 
            if(request("partida".$i) && request("cantidad".$i) && request("unidad".$i) && request("des".$i)){
                // dd('entre');
                $cadena = $cadena.'Partida: '.request("partida".$i) .' Cantidad: '.request("cantidad".$i).'   Unidad: '.request("unidad".$i).'   Descripción: '.request("des".$i)."\n";
            }
        }
        $folio_1 = $request->folio.'-'.date('y');
        //dd($folio_1);
        $ext = '.pdf';
        if($request->ireferencia){
            $request->validate([
                'ireferencia' => ' file | max:2048'
            ]);
            $destinationPath = public_path('documentos/referencias');
            $ireferencia= $request->ireferencia;
            $ndocumento = $folio_1.'_ireferencia'.$ext;
            $ireferencia->move($destinationPath,$ndocumento);
        }

        if($request->spresupuestal){
            $request->validate([
                'spresupuestal' => ' file | max:2048'
            ]);
            $destinationPath_1 = public_path('documentos/presupuestal');
            $spresupuestal= $request->spresupuestal;
            $ndocumento_1 = $folio_1.'_spresupuestal'.$ext;
            $spresupuestal->move($destinationPath_1,$ndocumento_1);
        }
        $requi = 'Partida: '.$request->partida.' Cantidad: '.$request->cantidad.'   Unidad: '.$request->unidad.'   Descripción: '.$request->des."\n";
        $nuevaadqui = new Adquisicion;
        $nuevaadqui->fechaadqui = date('Y-m-d');
        $nuevaadqui->folio = $folio_1;
        $nuevaadqui->cat_dep = $request->dependencia;
        $nuevaadqui->partida = strtoupper($request->ppresupuestal);
        $nuevaadqui->adqui_norequi = $request->nrequisicion;
        $nuevaadqui->adqui_refe = $ndocumento;
        $nuevaadqui->adqui_presupuesto = $ndocumento_1;
        $nuevaadqui->adqui_contenido = $requi.$cadena;
        //dd($nuevaadqui);
        $nuevaadqui->save();
        return back()->with('success', 'Adquisición agregada exitosamente!');
    }

    public function actualizaradquisicion($id, Request $request){
        //dd($id,$request);
        $ext = '.pdf';
        if($request->dpresentado_1){
            $request->validate([
                'dpresentado_1' => ' file | max:2048'
            ]);
            $destinationPath = public_path('documentos/documentospresentados');
            $dpresentado= $request->dpresentado_1;
            $ndocumento = $request->folio_1.'_dpresentado'.$ext;
            $dpresentado->move($destinationPath,$ndocumento);
        }

        if($request->imercado_1){
            $request->validate([
                'imercado_1' => ' file | max:2048'
            ]);
            $destinationPath_1 = public_path('documentos/investigaciondemercado');
            $imercado= $request->imercado_1;
            $ndocumento_1 = $request->folio_1.'_imercado'.$ext;
            $imercado->move($destinationPath_1,$ndocumento_1);
        }

        if($request->rrequisitoria_1){
            $request->validate([
                'rrequisitoria_1' => ' file | max:2048'
            ]);
            $destinationPath_2 = public_path('documentos/respuestarequisitoria');
            $rrequisitoria= $request->rrequisitoria_1;
            $ndocumento_2 = $request->folio_1.'_rrequisitoria'.$ext;
            $rrequisitoria->move($destinationPath_2,$ndocumento_2);
        }
        //dd($request);
        $actadqui = Adquisicion::find($id);
        if($request->dpresentado_1){
            $actadqui->documento = $ndocumento;
        }
        if($request->imercado_1){
            $actadqui->investigacion = $ndocumento_1;
        }
        if($request->rrequisitoria_1){
            $actadqui->resrequi = $ndocumento_2;
        }
        $actadqui->partida = $request->ppresupuestal_1;
        if($request->clasificacion_1){
            $actadqui->cat_clas = $request->clasificacion_1;
        }
        if($request->umedida_1){
            $actadqui->cat_med = $request->umedida_1;
        }
        if($request->ffinanciamiento_1){
            $actadqui->cat_fin = $request->ffinanciamiento_1;
        }
        
        if ($request->proveedor_1) {
            //dd($request->proveedor_1);
            $prove = explode("-",$request->proveedor_1);
            $actadqui->proveedor = $prove[0];    
        }
        $actadqui->monto = $request->monto_1;
        
        $actadqui->fechaaprox = $request->faprox_1;
        $actadqui->fechaentrega = $request->fentrega_1;
        $actadqui->descripcion = $request->dgeneral_1;
        $actadqui->descripcionadqui = $request->dadquisicion_1;
        if($actadqui->observaciones){
            $actadqui->observaciones = $actadqui->observaciones."\n ".$request->observaciones_1.' con fecha:'.date("d/m/Y h:i:s A");
        }else{
            $actadqui->observaciones = $request->observaciones_1.' con fecha:'.date("d/m/Y h:i:s A");
        }
        if($request->estatus_adqui==2){
            $actadqui->adquisicion_estatus = 2;
        }elseif($request->estatus_adqui==0){
            $actadqui->adquisicion_estatus = 0;
        }elseif($request->estatus_adqui==4){
            $actadqui->adquisicion_estatus = 4;
        }else{
            $actadqui->adquisicion_estatus = $request->estatus_adqui;
        }
        $actadqui->save();
        return back()->with('success', 'Adquisición actualizada exitosamente!');
    }

    public function almacenespera(){
        $fecha = date("d/m/Y");
        $clasificaciones = Clasificacion::where('clasificacion_estatus',1)->get();
        $dependencias = Dependencia::where('dependencia_estatus',1)->get();
        $financiamientos = Financiamiento::where('financimiento_estatus',1)->get();
        $medidas = Medida::where('medida_estatus',1)->get();
        $adquisiciones = DB::table('adquisicions')
        ->join('dependencias','adquisicions.cat_dep','dependencias.iddependencia')
        ->leftJoin('clasificacions','adquisicions.cat_clas','=','clasificacions.idclasificacion')
        ->leftJoin('medidas','adquisicions.cat_med','=','medidas.idmedida')
        ->leftJoin('financiamientos','adquisicions.cat_fin','=','financiamientos.idfinanciamiento')
        ->leftJoin('proveedors','adquisicions.proveedor','=','proveedors.idproveedor')
        ->select('adquisicions.*','dependencias.dependencia_nombre','clasificacions.clasificacion_nombre','medidas.medida_nombre',
        'financiamientos.financiamiento_nombre','proveedors.idproveedor','proveedors.nombre_comercial')
        ->where('adquisicion_estatus',4)
        ->get();
        //dd($adquisiciones);
        $proveedores = Proveedor::all();
        $tipo = 4;
        return view('adquisiciones.indexalmacen',compact('tipo','clasificaciones','dependencias','financiamientos','medidas','adquisiciones','fecha','proveedores'));
    }

    public function enalmacen(){
        
        $adquisiciones = DB::table('adquisicions')
        ->join('dependencias','adquisicions.cat_dep','dependencias.iddependencia')
        ->leftJoin('clasificacions','adquisicions.cat_clas','=','clasificacions.idclasificacion')
        ->leftJoin('medidas','adquisicions.cat_med','=','medidas.idmedida')
        ->leftJoin('financiamientos','adquisicions.cat_fin','=','financiamientos.idfinanciamiento')
        ->leftJoin('proveedors','adquisicions.proveedor','=','proveedors.idproveedor')
        ->select('adquisicions.*','dependencias.dependencia_nombre','clasificacions.clasificacion_nombre','medidas.medida_nombre',
        'financiamientos.financiamiento_nombre','proveedors.idproveedor','proveedors.nombre_comercial')
        ->where('adquisicion_estatus',5)
        ->get();
        $tipo = 5;
        return view('adquisiciones.almacen',compact('adquisiciones','tipo'));
    }

    public function almancenentregada(){
        
        $adquisiciones = DB::table('adquisicions')
        ->join('dependencias','adquisicions.cat_dep','dependencias.iddependencia')
        ->leftJoin('clasificacions','adquisicions.cat_clas','=','clasificacions.idclasificacion')
        ->leftJoin('medidas','adquisicions.cat_med','=','medidas.idmedida')
        ->leftJoin('financiamientos','adquisicions.cat_fin','=','financiamientos.idfinanciamiento')
        ->leftJoin('proveedors','adquisicions.proveedor','=','proveedors.idproveedor')
        ->select('adquisicions.*','dependencias.dependencia_nombre','clasificacions.clasificacion_nombre','medidas.medida_nombre',
        'financiamientos.financiamiento_nombre','proveedors.idproveedor','proveedors.nombre_comercial')
        ->where('adquisicion_estatus',6)
        ->get();
        //dd($adquisiciones);
        $tipo = 6;
        return view('adquisiciones.almacen',compact('adquisiciones', 'tipo'));
    }

    public function observacionadqui($id, Request $request){
        $adquisicion = Adquisicion::find($id);
        if ($adquisicion->observaciones == null) {
            $adquisicion->observaciones = Auth::user()->name.': '.$request->observacion.' Con fecha '.date("d/m/Y h:i:s A");
        } else {
            $adquisicion->observaciones =$adquisicion->observaciones."\n".Auth::user()->name.': '.$request->observacion.' Con fecha '.date("d/m/Y h:i:s A");
        }
        $adquisicion->save();
        return back()->with('success', 'Observación agregada correctamente!');
        
    }

}
