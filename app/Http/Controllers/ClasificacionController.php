<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use Illuminate\Http\Request;

class ClasificacionController extends Controller
{
    public function index(){
        //dd('Secciones clasificaciones');
        $clasificaciones = Clasificacion::where('clasificacion_estatus',1)->get();
        $clasificaciones_1 = Clasificacion::where('clasificacion_estatus',0)->get();
        return view ('clasificaciones.index',compact('clasificaciones','clasificaciones_1'));
    }

    public function agregarclasificacion(Request $request){
        //dd("Se agrega una clasificacion");
        $request->validate([
            'nombre' => 'required | string | min:2'
        ]);
        $nuevaclasificacion = new Clasificacion;
        $nuevaclasificacion->clasificacion_nombre = $request->nombre;
        $nuevaclasificacion->save();
        return back()->with('success', 'Clasificación guardada exitosamente!');
    }

    public function actulizarclasificacion($id, Request $request){
        $request->validate([
            'nombre' => 'required | string | min:2'
        ]);
        $actclasificacion = Clasificacion::find($id);
        $actclasificacion->clasificacion_nombre = $request->nombre;
        $actclasificacion->save();
        return back()->with('success', 'Clasificación actualizada exitosamente!');
    }

    public function bajaclasificacion($id){
        $bajaclasificacion = Clasificacion::find($id);
        
        if ($bajaclasificacion->clasificacion_estatus == 1) {
            $bajaclasificacion->clasificacion_estatus = 0;
            $bajaclasificacion->save();
            return back()->with('success', 'Clasificación dada de baja exitosamente!');
        }else{
            $bajaclasificacion->clasificacion_estatus = 1;
            $bajaclasificacion->save();
            return back()->with('success', 'Clasificación activada exitosamente!');
        }
        
    }
}
