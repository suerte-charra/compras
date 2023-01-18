<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use App\Models\Dependencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //
    public function cambioPassword($id){
        //dd($id);
        $clasificaciones = Clasificacion::all();
        return view('usuarios.configuracion',compact('clasificaciones'));
    }

    public function actulizarDatos($id, Request $request){
        //dd($request);
        $request->validate([
            'nombre'=> 'required | string | min:3',
            'correo' => 'required | string | email | max:255',
            'password' => 'confirmed | min:6 | max:8',
        ]);
        //dd($request);
        if ($request->password) {
            $uptUsuario = User::find($id);
            $uptUsuario->name = $request->nombre;
            $uptUsuario->email = $request->correo;
            $uptUsuario->password = Hash::make($request->password);
            $uptUsuario->save();
            return back()->with('success', 'Datos y contraseña actulizados exitosamente!');
        }else{
            $uptUsuario = User::find($id);
            $uptUsuario->name = $request->nombre;
            $uptUsuario->email = $request->correo;
            $uptUsuario->save();
            return back()->with('success', 'Datos actulizados exitosamente!');
        }
    }

    public function indiceusuario(){
        
        $usuarios = DB::table('users')
                        ->leftJoin('dependencias','iddependencia','user_iddependencia')
                        ->select('users.*','dependencias.dependencia_nombre')
                        ->where('user_estatus',1)
                        ->get();
        $usuarios_1 = User::where('user_estatus',0)->get();
        $dependencias = Dependencia::where('dependencia_estatus',1)->get();
        return view ('usuarios.indice',compact('usuarios','usuarios_1','dependencias'));
    }

    public function agregarusuario(Request $request){
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required',
            'categoria' => 'required'
        ]);

        $contrasena = 'pass123';
        $nuevousuario = new User;
        $nuevousuario->name = $request->nombre;
        $nuevousuario->email = $request->correo;
        $nuevousuario->categoria = $request->categoria;
        $nuevousuario->password = Hash::make($contrasena);

        $nuevousuario->save();
        return back()->with('success', 'Usuario creado exitosamente!');
    }

    public function bajausuario($id){
        $bajausuario = User::find($id);
        
        if ($bajausuario->user_estatus == 1) {
            $bajausuario->user_estatus = 0;
            $bajausuario->save();
            return back()->with('success', 'Usuario dado de baja exitosamente!');
        }else{
            $bajausuario->user_estatus = 1;
            $bajausuario->save();
            return back()->with('success', 'Usuario activado exitosamente!');
        }

    }
}
