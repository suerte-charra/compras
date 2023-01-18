<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function indiceproveedor(){
        $proveedores = Proveedor::where('proveedor_estatus',1)->get();
        $proveedores_1 = Proveedor::where('proveedor_estatus',0)->get();
        return view ('proveedores.index',compact('proveedores','proveedores_1'));
    }
    public function agregarproveedor(Request $request){
        $request->validate([
            'rfc' => 'required | max:14 | min:13'
        ]);
        try {
            $nuevoproveedor = new Proveedor;
            $nuevoproveedor->nombre_comercial = $request->ncomercial;
            $nuevoproveedor->rfc = $request->rfc;
            $nuevoproveedor->direccion = $request->direccion;
            $nuevoproveedor->correo = $request->correo;
            $nuevoproveedor->giro = $request->giro;
            $nuevoproveedor->nombre = $request->nombre;
            $nuevoproveedor->save();
            return back()->with('success', 'Proveedor guardado exitosamente!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Rfc de proveedor ya registrado!');
        }
        
    }
    public function bajaproveedor($id){
        $bajaproveedor = Proveedor::find($id);

        if ($bajaproveedor->proveedor_estatus == 1) {
            $bajaproveedor->proveedor_estatus = 0;
            $bajaproveedor->save();
            return back()->with('success', 'Proveedor dado de baja exitosamente!');
        }else{
            $bajaproveedor->proveedor_estatus = 1;
            $bajaproveedor->save();
            return back()->with('success', 'Proveedor activado exitosamente!');
        }
    }
}
