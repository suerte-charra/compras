<?php

namespace App\Http\Controllers;

use App\Models\Adquisicion;
use App\Models\Dependencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresupuestosController extends Controller
{
    //
    public function inicioPresu()
    {
        $dependencias = Dependencia::select('iddependencia', 'dependencia_nombre', 'pre_total')->get();
        $pre_ejer = DB::table('dependencias')
            ->join('adquisicions', 'iddependencia', 'cat_dep')
            ->select('dependencia_nombre', DB::raw("SUM(monto) as gasto"), 'iddependencia')
            ->whereIn('adquisicion_estatus', [5, 6])
            ->groupBy('dependencias.iddependencia', 'dependencias.dependencia_nombre', 'monto')
            ->get();
        $pre_com = DB::table('dependencias')
            ->join('adquisicions', 'iddependencia', 'cat_dep')
            ->select( DB::raw("SUM(monto) as gasto"), 'dependencias.iddependencia')
            ->whereIn('adquisicion_estatus', [3, 4])
            ->groupBy('dependencias.iddependencia')
            ->get();
        $pre_usado = DB::table('dependencias')
            ->leftJoin('adquisicions', 'iddependencia', 'cat_dep')
            ->select('iddependencia', DB::raw("pre_total - SUM(monto) as restante"))
            ->whereIn('adquisicion_estatus', [3, 6])
            ->groupBy('dependencias.iddependencia',  'pre_total')
            ->get();
        //dd($pre_com);
        return view('presupuestos.index', compact('dependencias', 'pre_ejer', 'pre_com', 'pre_usado'));
    }
}
