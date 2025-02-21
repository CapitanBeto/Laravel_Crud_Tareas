<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ListaTareas;
use App\Models\Fotos;
use Carbon\Carbon; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TareasController extends Controller
{
    public function tareas_inicio()
    {

        return view('tareas.inicio');

    }

    public function tareas_mostrar()
    {
        if(session('perfil_id')!=1)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        elseif(session('perfil_id')!=2)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        else
        {
            $datos = ListaTareas::orderby('fecha', 'desc',)->orderby('hora','desc')->get();
            return view('tareas.paginacion', compact('datos'));
        }

    }

    public function tareas_crear()
    {
        if(session('perfil_id')==null)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        return view('tareas.crear');
    }
   

    public function tareas_crear_post(Request $request)
    {
        $datos = User::orderby('id')->get();
        $request->validate([
            'titulo'=>'required|string|max:255',
            'descripcion'=>'nullable|string',
            'autor'=>'required|string|max:255',
        ],[
            'titulo.required'=>'Ingresa un título',
            'titulo.max'=>'El título puede tener como máximo 255 caracteres',
            'autor.required'=>'Ingresa un autor',
            'autor.max'=>'El nombre del autor puede tener como máximo 255 caracteres'
        ]);
        

        
        $fecha = Carbon::now()->format('Y-m-d');
        $hora = Carbon::now()->format('H:i:s');
        $usuario1 = User::where(['name'=>Auth::user()->name])->first();
        ListaTareas::create([
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'autor' => $usuario1->name,
            'fecha' => $fecha, 
            'hora' => $hora,    
        ]);
        
    
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "Se creó el registro");
    
        return redirect()->route('tareas_crear');
    }
    

    public function tareas_editar($id)
    {
        if(session('perfil_id')==null)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        $tareas = ListaTareas::where(['id'=>$id])->firstorfail();
        return view('tareas.editar', compact('tareas'));
    }

    public function tareas_editar_post(Request $request, $id)
    {
        $tareas = ListaTareas::where(['id'=>$id])->firstorfail();
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'autor' => 'required|string|max:255',

        ],
        [
            'titulo.required'=>'El título está vacío',
            'titulo.max'=>'El título puede tener como máximo 255 caracteres',
            'autor.required'=>'El autor está vacío',
            'autor.max'=>'El nombre del autor puede tener como máximo 255 caracteres'
        ]);

        $tareas->titulo = $request->input('titulo');
        $tareas->descripcion = $request->input('descripcion');
        $tareas->autor = $request->input('autor');
        $tareas->save();
        
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "se editó el registro");
        return redirect()->route('tareas_editar', ['id'=>$id]);
    }

    public function tareas_eliminar(Request $request, $id)
    {
        
        ListaTareas::where(['id'=>$id])->delete();
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "se eliminó el registro...");
        return redirect()->route('tareas_paginacion');
    }

    public function tareas_fotos($id)
    {
        if(session('perfil_id')==null)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        $tareas = ListaTareas::where(['id'=>$id])->firstorfail();
        $fotos = Fotos::where(['tareas_id'=>$id])->get();
        return view('tareas.fotos', compact('fotos', 'tareas'));
    }
    public function tareas_fotos_post(Request $request, $id)
    {

        $request->validate([
            'fotos.*' => 'required|mimes:jpg,bmp,png|max:2048',
        ], [
            'fotos.*.required' => 'Ninguna foto seleccionada',
            'fotos.*.mimes' => 'La foto debe ser JPG o PNG',
            'fotos.*.max' => 'El tamaño máximo es de 2048 KB'
        ]);
        foreach ($_FILES['fotos']['name'] as $key => $nombre) {
            $archivo = '';
            switch ($_FILES['fotos']['type'][$key]) {
                case 'image/png':
                    $archivo = time().$nombre.".png";
                    break;
                case 'image/jpeg':
                    $archivo = time().$nombre.".jpg";
                    break;
            }
            if ($archivo) { 
                copy($_FILES['fotos']['tmp_name'][$key], 'uploads/fotos/'.$archivo);
                Fotos::create([
                    'tareas_id' => $id,
                    'nombre' => $archivo
                    
                ]);
                $request->session()->flash('css', 'success');
                $request->session()->flash('mensaje', "foto añadida correctamente");
            }
            else{
                $request->session()->flash('css', 'warning');
                $request->session()->flash('mensaje', "no hay ninguna foto seleccionada");
            }
        }

        return redirect()->route('tareas_fotos', $id);
    }
    


    public function tareas_fotos_eliminar(Request $request, $id, $foto_id)
    {
        if(session('perfil_id')==null)
        {
            return redirect()->route('protegida_sin_acceso');
        }

        $foto = Fotos::where(['id'=>$foto_id])->firstorfail();

        unlink('uploads/fotos/'.$foto->nombre);
        Fotos::where(['id'=>$foto_id])->delete();
        $request->session()->flash('css', 'success');
        $request->session()->flash('mensaje', "foto eliminada correctamente");
        return redirect()->route('tareas_fotos', ['id'=>$id]);

    }

    public function tareas_paginacion()
    {
        if(session('perfil_id')==null)
        {
            return redirect()->route('protegida_sin_acceso');
        }
        $datos = ListaTareas::orderBy('id', 'desc')->paginate(2);
        return view('tareas.paginacion', compact('datos'));
    }
}    