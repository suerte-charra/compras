<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use App\Models\Financiamiento;
use Illuminate\Http\Request;

class FinancimientoController extends Controller
{
    public function indicefinancimiento()
    {
        //dd('Seccion financimiento');
        $financiamientos = Financiamiento::where('financimiento_estatus', 1)->get();
        $financiamientos_1 = Financiamiento::where('financimiento_estatus', 0)->get();
        return view('financiamiento.index', compact('financiamientos', 'financiamientos_1'));
    }
    public function agregarfinanciamiento(Request $request)
    {
        $request->validate([
            'nombre' => 'required | string | min:2 | unique:financiamientos,financiamiento_nombre'
        ]);
        $nuevofinanciamiento = new Financiamiento;
        $nuevofinanciamiento->financiamiento_nombre = strtoupper($request->nombre);
        $nuevofinanciamiento->save();
        return back()->with('success', 'Fuente de financiamiento guardada exitosamente!');
    }
    public function actualizarfinanciamiento($id, Request $request)
    {
        $request->validate([
            'nombre' => 'required | string | min:2'
        ]);
        $actfinanciamiento = Financiamiento::find($id);
        $actfinanciamiento->financiamiento_nombre = $request->nombre;
        $actfinanciamiento->save();
        return back()->with('success', 'Fuente de financiamiento actualizada exitosamente!');
    }
    public function bajafinanciamiento($id)
    {
        $bajafinanciamiento = Financiamiento::find($id);

        if ($bajafinanciamiento->financimiento_estatus == 1) {
            $bajafinanciamiento->financimiento_estatus = 0;
            $bajafinanciamiento->save();
            return back()->with('success', 'Fuente de financiamiento dada de baja exitosamente!');
        } else {
            $bajafinanciamiento->financimiento_estatus = 1;
            $bajafinanciamiento->save();
            return back()->with('success', 'Fuente de financiamiento activada exitosamente!');
        }
    }

    public function importarPresupuestos(Request $request)
    {
        //dd('holas');
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);
        //dd($request);
        $rutaArchivo = $request->file('csv_file')->getRealPath();
        $datosCSV = array_map('str_getcsv', file($rutaArchivo));
        //dd($datosCSV);
        foreach ($datosCSV as $row) {
            $registro = Dependencia::where('dependencia_nombre', $row[1])->first();
            
            if ($registro) {
                $registro->pre_total = $row[2];
                $registro->save();
            }
        }
        return redirect()->back()->with('success', 'El archivo ha sido importado exitosamente.');
    }
}
