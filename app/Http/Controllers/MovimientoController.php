<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use DateTimeImmutable;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index(){
        return view('movimientos.index');
    }

    public function bmov(Request $request){
        if($request->finicial == $request->ffinal){
            $dt1 = new DateTimeImmutable($request->finicial);
        
            $ndt1 = $dt1->setTime(00,00,00);
            $ndt1->format('Y-m-d H:i:s');
    
            $ndt2 = $dt1->setTime(23, 59, 00);
            $ndt2->format('Y-m-d H:i:s');

            $resultados = Registro::where('created_at','>=', $ndt1)->where('created_at','<=', $ndt2)->get();

            return view('movimientos.resultados',compact('resultados'));
        }elseif($request->finicial > $request->ffinal){

            return redirect(route('indicemov'))->with('error', 'Las fechas están incorrectas!');
        }else{
            $dt1 = new DateTimeImmutable($request->finicial);
            $dt2 = new DateTimeImmutable($request->ffinal);
        
            $ndt1 = $dt1->setTime(00,00,00);
            $ndt1->format('Y-m-d H:i:s');

            $ndt2 = $dt2->setTime(23, 59,00);
            $ndt2->format('Y-m-d H:i:s');

            $resultados = Registro::where('created_at','>=', $ndt1)->where('created_at','<=',$ndt2)->get();
            return view('movimientos.resultados',compact('resultados'));
        } 
        //dd($resultados);
        
    }

}
