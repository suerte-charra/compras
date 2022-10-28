<?php

namespace App\Http\Controllers;

use App\Models\Financiamiento;
use Illuminate\Http\Request;

class FinancimientoController extends Controller
{
    public function indicefinancimiento(){
        //dd('Seccion financimiento');
        $financiamientos = Financiamiento::where('financimiento_estatus',1)->get();
        $financiamientos_1 = Financiamiento::where('financimiento_estatus',0)->get();
        return view ('financiamiento.index',compact('financiamientos','financiamientos_1'));
    }
    public function agregarfinanciamiento(Request $request){
        $request->validate([
            'nombre' => 'required | string | min:2'
        ]);
        $nuevofinanciamiento = new Financiamiento;
        $nuevofinanciamiento->financiamiento_nombre = $request->nombre;
        $nuevofinanciamiento->save();
        return back()->with('success', 'Fuente de financiamiento guardada exitosamente!');
    }
    public function actualizarfinanciamiento($id, Request $request){
        $request->validate([
            'nombre' => 'required | string | min:2'
        ]);
        $actfinanciamiento = Financiamiento::find($id);
        $actfinanciamiento->financiamiento_nombre = $request->nombre;
        $actfinanciamiento->save();
        return back()->with('success', 'Fuente de financiamiento actualizada exitosamente!');
    }
    public function bajafinanciamiento($id){
        $bajafinanciamiento = Financiamiento::find($id);
        
        if ($bajafinanciamiento->financimiento_estatus == 1) {
            $bajafinanciamiento->financimiento_estatus = 0;
            $bajafinanciamiento->save();
            return back()->with('success', 'Fuente de financiamiento dada de baja exitosamente!');
        }else{
            $bajafinanciamiento->financimiento_estatus = 1;
            $bajafinanciamiento->save();
            return back()->with('success', 'Fuente de financiamiento activada exitosamente!');
        }
    }
}
