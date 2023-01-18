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
        }elseif(Auth::user()->categoria == 'almacen'){
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
            ->where('adquisicion_estatus',4)
            ->orWhere('adquisicion_estatus',5)
            ->get();
            //dd($adquisiciones);
            $proveedores = Proveedor::all();
            return view('adquisiciones.indexalmacen',compact('clasificaciones','dependencias','financiamientos','medidas','adquisiciones','fecha','proveedores'));
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
            'financiamientos.financiamiento_nombre','proveedors.nombre_comercial')
            ->where('adquisicion_estatus',2)
            ->get();
        //dd($adquisicionesaprobadas);
            return view('adquisiciones.aprobadas',compact('adquisicionesaprobadas', 'clasificaciones','medidas','financiamientos', 'proveedores'));
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
        
        $request->validate([
            //'fingreso'=>'required',
            'folio'=>'required | min:5 | max:5',
            'dependencia'=>'required'
            // 'clasificacion'=>'required',
            // 'umedida'=>'required',
            // 'ffinanciamiento'=>'required',
            // 'dpresentado'=>'required | mimes:pdf | max:2028',
            
        ]);
        //dd($request);
        $ext = '.pdf';
        $ndocumento = NULL;
        if($request->dpresentado){
            $request->validate([
                'dpresentado' => 'mimes:pdf|max:2048'
            ]);
            $destinationPath = public_path('documentos/documentospresentados');
            $dpresentado= $request->dpresentado;
            $ndocumento = $request->folio.'-'.date('y').'_dpresentado'.$ext;
            $dpresentado->move($destinationPath,$ndocumento);
        }

        $ninvestigacion = NULL;
        if($request->imercado){
            $request->validate([
                'imercado' => 'mimes:pdf|max:2048'
            ]);
            $destinationPath = public_path('documentos/investigaciondemercado');
            $imercado= $request->imercado;
            $ninvestigacion = $request->folio.'-'.date('y').'_imercado'.$ext;
            $imercado->move($destinationPath,$ninvestigacion);
        }

        $nresrequi = NULL;
        if($request->rrequisitoria){
            $request->validate([
                'rrequisitoria' => 'mimes:pdf|max:2048'
            ]);
            $destinationPath = public_path('documentos/respuestarequisitoria');
            $rrequisitoria= $request->rrequisitoria;
            $nresrequi = $request->folio.'-'.date('y').'_rrequisitoria'.$ext;
            $rrequisitoria->move($destinationPath,$nresrequi);
        }
        try {
            $nadquisicion = new Adquisicion;
            $nadquisicion->fechaadqui = date('Y-m-d');
            $nadquisicion->folio = $request->folio.'-'.date('y');
            $nadquisicion->partida = $request->ppresupuestal;
            $nadquisicion->descripcion = $request->dgeneral;
            $nadquisicion->descripcionadqui = $request->dadquisicion;
            $nadquisicion->monto = $request->monto;
            $nadquisicion->proveedor = $request->proveedor;
            $nadquisicion->fechaaprox = $request->faprox;
            $nadquisicion->fechaentrega = $request->fentrega;
            if($request->observaciones){
                $nadquisicion->observaciones = $request->observaciones.' con fecha:'.date("d/m/Y h:i:s A");  
            }
            $nadquisicion->cat_dep = $request->dependencia;
            $nadquisicion->cat_clas = $request->clasificacion;
            $nadquisicion->cat_med = $request->umedida;
            $nadquisicion->cat_fin = $request->ffinanciamiento;
            $nadquisicion->documento = $ndocumento;
            $nadquisicion->investigacion = $ninvestigacion;
            $nadquisicion->resrequi = $nresrequi;
            $nadquisicion->save();
            return back()->with('success', 'Adquisición guardada exitosamente!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Folio de adquisición ya existente!');
        }
        // dd($nadquisicion);
    }

    public function actualizaradquisicion($id, Request $request){
        //dd($id,$request);
        $ext = '.pdf';
        if($request->dpresentado_1){
            $destinationPath = public_path('documentos/documentospresentados');
            $dpresentado= $request->dpresentado_1;
            $ndocumento = $request->folio_1.'_dpresentado'.$ext;
            $dpresentado->move($destinationPath,$ndocumento);
        }

        if($request->imercado_1){
            $destinationPath_1 = public_path('documentos/investigaciondemercado');
            $imercado= $request->imercado_1;
            $ndocumento_1 = $request->folio_1.'_imercado'.$ext;
            $imercado->move($destinationPath_1,$ndocumento_1);
        }

        if($request->rrequisitoria_1){
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
        if (strlen($request->proveedor_1) > 2) {
            $prove = explode("-",$request->proveedor_1);
            $actadqui->proveedor = $prove[0];    
        }
        $actadqui->monto = $request->monto_1;
        
        $actadqui->fechaaprox = $request->faprox_1;
        $actadqui->fechaentrega = $request->fentrega_1;
        $actadqui->descripcion = $request->dgeneral_1;
        $actadqui->descripcionadqui = $request->dadquisicion_1;
        if($actadqui->observaciones){
            $actadqui->observaciones = $actadqui->observaciones." \n ".$request->observaciones_1.' con fecha:'.date("d/m/Y h:i:s A");
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

    // public function camadquiestatus($id,Request $request){
    //     $request->validate([
    //         'estatus_adqui'=>'required'
    //     ]);
    //     //dd($request);
    //     $camadquiesatus = Adquisicion::find($id);
    //     if($request->estatus_adqui==2){
    //         $camadquiesatus->adquisicion_estatus = 2;
    //         $camadquiesatus->save();
    //         return back()->with('success', 'Adquisición aprobada exitosamente!');
    //     }elseif($request->estatus_adqui==0){
    //         $camadquiesatus->adquisicion_estatus = 0;
    //         $camadquiesatus->save();
    //         return back()->with('success', 'Adquisición rechazada!');
    //     }else{
    //         return back()->with('error', 'No se pudo realizar la acción!');
    //     }
    // }
}
