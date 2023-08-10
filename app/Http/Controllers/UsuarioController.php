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
    public function cambioPassword($id)
    {
        //dd($id);
        $clasificaciones = Clasificacion::all();
        return view('usuarios.configuracion', compact('clasificaciones'));
    }

    public function actulizarDatos($id, Request $request)
    {
        //dd($request);
        // $request->validate([
        //     'nombre'=> 'required | string | min:3',
        //     'correo' => 'required | string | email | max:255',
        //     'password' => 'confirmed | min:6 | max:8',
        // ]);
        //dd($request);
        if ($request->password) {
            $request->validate([
                'nombre' => 'required | string | min:3',
                'correo' => 'required | string | email | max:255',
                'password' => 'confirmed | min:6 | max:8',
            ]);
            $uptUsuario = User::find($id);
            $uptUsuario->name = $request->nombre;
            $uptUsuario->email = $request->correo;
            $uptUsuario->password = Hash::make($request->password);
            $uptUsuario->user_passestatus = 1;
            $uptUsuario->save();
            return back()->with('success', 'Datos y contraseña actulizados exitosamente!');
        } else {
            $request->validate([
                'nombre' => 'required | string | min:3',
                'correo' => 'required | string | email | max:255',
                //'password' => 'confirmed | min:6 | max:8',
            ]);
            $uptUsuario = User::find($id);
            $uptUsuario->name = $request->nombre;
            $uptUsuario->email = $request->correo;
            $uptUsuario->save();
            return back()->with('success', 'Datos actulizados exitosamente!');
        }
    }

    public function indiceusuario()
    {

        $usuarios = DB::table('users')
            ->leftJoin('dependencias', 'iddependencia', 'user_iddependencia')
            ->select('users.*', 'dependencias.dependencia_nombre')
            ->where('user_estatus', 1)
            ->get();
        $usuarios_1 = User::where('user_estatus', 0)->get();
        $dependencias = Dependencia::where('dependencia_estatus', 1)->get();
        return view('usuarios.indice', compact('usuarios', 'usuarios_1', 'dependencias'));
    }

    public function agregarusuario(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required |string |email| max:255 |unique:users,email',
            'categoria' => 'required',
        ]);
        //dd($request);
        $contrasena = 'pass123';
        $nuevousuario = new User;
        $nuevousuario->name = $request->nombre;
        $nuevousuario->email = $request->correo;
        $nuevousuario->categoria = $request->categoria;
        if ($request->dependencia) {
            $nuevousuario->user_iddependencia = $request->dependencia;
        }
        $nuevousuario->password = Hash::make($contrasena);

        $nuevousuario->save();
        return back()->with('success', 'Usuario creado exitosamente!');
    }

    public function bajausuario($id)
    {
        $bajausuario = User::find($id);

        if ($bajausuario->user_estatus == 1) {
            $bajausuario->user_estatus = 0;
            $bajausuario->save();
            return back()->with('success', 'Usuario dado de baja exitosamente!');
        } else {
            $bajausuario->user_estatus = 1;
            $bajausuario->save();
            return back()->with('success', 'Usuario activado exitosamente!');
        }
    }

    public function restablecePass($idusuario)
    {
        $usuario = User::leftJoin('dependencias', 'iddependencia', 'user_iddependencia')
            ->select('id','name','email','categoria','user_iddependencia','dependencia_nombre')
            ->where('id', $idusuario)->first();
        $dependencias = Dependencia::select('iddependencia', 'dependencia_nombre')->where('dependencia_estatus', 1)->get();
        //dd($usuario);
        return view('usuarios.informacion', compact('usuario', 'dependencias'));
        dd($idusuario);
    }

    public function userUpdate($idusuario, Request $request){
        $usuario = User::find($idusuario);
        if ($request->dependencia != 0) {
            $usuario->user_iddependencia = $request->dependencia;
        }
        if ($request->categoria != 0) {
            $usuario->categoria = $request->categoria;
        }
        if($request->restaurar){
            $usuario->password = Hash::make('pass123');
            $usuario->user_passestatus = 0;
        }
        //$usuario->save();
        //dd($idusuario, $request, $usuario);
        return back()->with('success', 'Usuario actualizado exitosamente!');
    }
}
