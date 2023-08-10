<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use Illuminate\Http\Request;

class DependenciaController extends Controller
{
    public function indicedependencia(){
        $dependencias = Dependencia::where('dependencia_estatus',1)->get();
        $dependencias_1 = Dependencia::where('dependencia_estatus',0)->get();
        return view ('dependencias.index',compact('dependencias','dependencias_1'));
    }
    public function agregardependencia(Request $request){
        $request->validate([
            'nombre' => 'required | string | min:2 |unique:dependencias,dependencia_nombre'
        ]);
        $nuevadependencia = new Dependencia;
        $nuevadependencia->dependencia_nombre = strtoupper($request->nombre);
        $nuevadependencia->save();
        return back()->with('success', 'Dependencia guardada exitosamente!');
    }
    public function actulizardependencia($id, Request $request){
        $request->validate([
            'nombre' => 'required | string | min:2'
        ]);
        $actdependencia = Dependencia::find($id);
        $actdependencia->dependencia_nombre = $request->nombre;
        $actdependencia->save();
        return back()->with('success', 'Dependencia actualizada exitosamente!');
    }
    public function bajadependencia($id){
        $bajadependencia = Dependencia::find($id);
        
        if ($bajadependencia->dependencia_estatus == 1) {
            $bajadependencia->dependencia_estatus = 0;
            $bajadependencia->save();
            return back()->with('success', 'Dependencia dada de baja exitosamente!');
        }else{
            $bajadependencia->dependencia_estatus = 1;
            $bajadependencia->save();
            return back()->with('success', 'Dependencia activada exitosamente!');
        }
    }
}
