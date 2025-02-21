<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMetadata;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccesoController extends Controller
{
    public function acceso_login()
    {
        if(session('perfil_id')!=null)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        return view('acceso.login');

    }

    public function acceso_login_post(Request $request)
    {
        $request->validate(
        [
        'correo' => 'required|email:rfc,dns',
        'password' => 'required'
        ],
        [
            'correo.required'=>'Ingresa un E-mail',
            'correo.email' => 'Ingresa un E-mail válido',
            'password.required'=>'Ingresa una contraseña'

        ]
        );
        if(Auth::attempt(['email'=>$request->input('correo'),
        'password'=>$request->input('password')]))
        {
            $usuario = UserMetadata::where(['users_id'=>Auth::id()])->first();
            session(['users_metadata_id'=>$usuario->id]);
            session(['perfil_id'=>$usuario->perfil_id]);
            session(['perfil' => $usuario->perfil->nombre]);
            
            return redirect()->intended('tareas/paginacion');
        }   
        else
        {
            $request->session()->flash('css', 'danger');
            $request->session()->flash('mensaje', 'Credenciales inválidas');
            return redirect()->route('acceso_login');
        }
    }

    public function acceso_registro()
    {
        if(session('perfil_id')!=null)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        return view('acceso.registro');
    }

    public function acceso_registro_post(Request $request)
    {
        $request->validate(
        [
            'nombre' => 'required|min:6',
            'correo' => 'required|email:rfc,dns|unique:users,email',
            'telefono' => 'required',
            'direccion' => 'required',
            'password' => 'required|min:6|confirmed'
        ],
        
        [
            'nombre.required' => 'El campo Nombre está vacío',
            'nombre.min' => 'El campo Nombre debe tener al menos 6 caracteres',
            'correo.required' => 'El campo E-Mail está vacío',
            'correo.email' => 'El E-Mail ingresado no es válido',
            'telefono.required' => 'El campo Teléfono está vacío',
            'direccion.required' => 'El campo Dirección está vacío',
            'password.required' => 'El campo Password está vacío',
            'password.min' => 'El campo Password debe tener al menos 6 caracteres',
            'password.confirmed' => 'Las contraseñas ingresadas no coinciden'
        ]
        );
        
        $user = User::create(
            [
                'name'=>$request->input('nombre'),
                'email'=>$request->input('correo'),
                'password'=>Hash::make($request->input('password')),
                'created_at'=>date('Y-m-d H:i:s')
            ]
            );
            UserMetadata::create(
                [
                    'users_id'=>$user->id,
                    'perfil_id'=>2,
                    'telefono'=>$request->input('telefono'),
                    'direccion'=>$request->input('direccion')
                    
                ]
                );
            $request->session()->flash('css', 'success');
            $request->session()->flash('mensaje', 'Se ha creado el registro, ahora inicia sesión');
            return redirect()->route('acceso_login');
    }

    public function acceso_salir(Request $request)
    {
        Auth::logout();
        $request->session()->forget('users_metadata_id');
        $request->session()->forget('perfil_id');
        $request->session()->forget('perfil');

        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', 'Cerraste la sesión');
        return redirect()->route('acceso_login');
    }
}
