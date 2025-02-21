<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserMetadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProtegidaController extends Controller
{
    public function protegida_inicio()
    {
        $datos = User::orderby('id')->get();
        $datos_u = UserMetadata::orderby('users_id')->get();
        if(session('perfil_id')!=1)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        return view('protegida.inicio', compact('datos', 'datos_u'));
    }

    public function protegida_sin_acceso()
    {
        return view('protegida.sin_acceso');
    }

    public function protegida_otra()
    {
        return view('protegida.otra');
    }

    public function protegida_editar($id)
    {
        if(session('perfil_id')!=1)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        
        $usuarios = User::where(['id'=>$id])->firstorfail();
        $usuarios_d = UserMetadata::where(['users_id'=>$id])->firstorfail();
        return view('protegida.editar', compact('usuarios', 'usuarios_d'));
    }

    
    public function protegida_editar_post(Request $request, $id)
    {
        $usuarios = User::where(['id'=>$id])->firstorfail();
        $usuarios_d = UserMetadata::where(['users_id'=>$id])->firstorfail();
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string',
            'telefono' => 'required|string|max:12',
            'direccion' => 'required|string|max:50'

        ],
        [
            'name.required'=>'El título está vacío',
            'name.max'=>'El título puede tener como máximo 255 caracteres',
            'email.required'=>'No puedes dejar el correo en blanco',
            'telefono.required'=>'El autor está vacío',
            'telefono.max'=>'El nombre del autor puede tener como máximo 255 caracteres',
            'direccion.required' =>'No puedes dejar la dirección en blanco'
        ]);

        $usuarios->name = $request->input('name');
        $usuarios->email = $request->input('email');
        $usuarios_d->telefono = $request->input('telefono');
        $usuarios_d->direccion = $request->input('direccion');
        $usuarios->save();
        $usuarios_d->save();
        
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "se editó el registro");
        return redirect()->route('protegida_editar', ['id'=>$id]);
    }

    public function protegida_admins()
    {
        {
            $datos = User::orderby('id')->get();
            $datos_u = UserMetadata::orderby('users_id')->get();
            if(session('perfil_id')!=1)
            {
                return redirect()->route('protegida_sin_acceso');
            }
            return view('protegida.admins', compact('datos', 'datos_u'));
        }
    }

    public function protegida_eliminar($id, Request $request)
    {

        if (Auth::id() == $id) {

            $request->session()->flash('css', 'danger');
            $request->session()->flash('mensaje', 'No puedes eliminar tu propia cuenta');
            return redirect()->route('protegida_inicio');
        }
    
        $usuario_e = User::find($id);
    
            $usuario_e->delete();
            $request->session()->flash('css', 'success');
            $request->session()->flash('mensaje', 'Se eliminó el registro...');
        
        return redirect()->route('protegida_inicio');
    }
    

    public function protegida_privilegios(Request $request, $id)
    {
        $usuario = UserMetadata::where(['users_id'=>$id])->firstorfail();
        $usuario->perfil_id = 1;
        $usuario->save();
        return redirect()->route('protegida_inicio');
    }
}
