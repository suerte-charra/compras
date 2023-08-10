<?php

namespace App\Http\Controllers;

use App\Models\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    public function indicemedida(){
        //dd('Seccion medidas');
        $medidas = Medida::where('medida_estatus',1)->get();
        $medidas_1 = Medida::where('medida_estatus',0)->get();
        return view ('medidas.index',compact('medidas','medidas_1'));
    }
    public function agregarmedida(Request $request){
        //dd($request);
        $request->validate([
            'nombre' => 'required | string | min:2 |unique:medidas,medida_nombre'
        ]);
        $nuevamedida = new Medida;
        $nuevamedida->medida_nombre = strtoupper($request->nombre);
        $nuevamedida->save();
        return back()->with('success', 'Unidad de medida guardada exitosamente!');
    }
    public function actualizarmedida($id, Request $request){
        $request->validate([
            'nombre' => 'required | string | min:2'
        ]);
        $actmedida = Medida::find($id);
        $actmedida->medida_nombre = $request->nombre;
        $actmedida->save();
        return back()->with('success', 'Unidad de medida actualizada exitosamente!');
    }
    public function bajamedida($id){
        $bajamedida = Medida::find($id);
        
        if ($bajamedida->medida_estatus == 1) {
            $bajamedida->medida_estatus = 0;
            $bajamedida->save();
            return back()->with('success', 'Unidad de medida dada de baja exitosamente!');
        }else{
            $bajamedida->medida_estatus = 1;
            $bajamedida->save();
            return back()->with('success', 'Unidad de medida activada exitosamente!');
        }
    }
}
