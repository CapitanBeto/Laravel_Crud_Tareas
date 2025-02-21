<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMetadata;
use App\Models\Fotos;

use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class apiFotosController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth.basic');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Fotos::orderBy('tareas_id','desc')->get();
        return response()->json($datos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        if(empty($_FILES['fotos']['tmp_name']))
        {
            $array=
                array
                (
                    'response'=>array
                    (
                        'estado' => 'Bad Request',
                        'mensaje'=> 'la foto es obligatoria'
                    )
                    );
                    return response()->json($array,400);
        }
        if($_FILES["fotos"]["type"]=='image/jpeg' or $_FILES["fotos"]["type"]=='image/png')
        {
            switch ($_FILES['fotos']['type']) {
                case 'image/png':
                    $archivo = time().".png";
                    break;
                case 'image/jpeg':
                    $archivo = time().".jpg";
                    break;
            }
            copy($_FILES["fotos"]["tmp_name"], "uploads/fotos/".$archivo);
            Fotos::create(
                [
                    'nombre'=>$archivo,
                    'tareas_id'=>$request->input('tareas_id')
                ]
                );
            $array=
                array
                (
                    'response'=>array
                    (
                        'estado' => 'OK',
                        'mensaje'=> 'TODO BIEN'
                    )
                    );
                    return response()->json($array,201);
        }
        else
        {
            $array=
                array
                (
                    'response'=>array
                    (
                        'estado' => 'Bad Request',
                        'mensaje'=> 'la foto no tiene un formato válido'
                    )
                    );
                    return response()->json($array,400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datos=Fotos::where(['id'=>$id])->firstOrFail();
        unlink("uploads/fotos/".$datos->nombre);
        Fotos::where(['id'=>$id])->delete();
        $array=
        array
        (
            'response'=>array
            (
                'estado' => 'Ok',
                'mensaje'=> 'la foto se eliminó correctamente'
            )
            );
            return response()->json($array,400);
    }
}
