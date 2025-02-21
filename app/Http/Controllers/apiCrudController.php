<?php

namespace App\Http\Controllers;
use App\Models\ListaTareas;
use Carbon\Carbon; 
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;

class apiCrudController extends Controller
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
        $datos = ListaTareas::orderBy('id', 'desc')->get();
        return response()->json($datos, 200);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $json = json_decode(file_get_contents('php://input'), true);
        if (!is_array($json))
        {
            $array=
                array
                (
                    'response'=>array
                    (
                        'estado' => 'Bad Request',
                        'mensaje'=> 'La petición HTTP no trae datos'
                    )
                    );
                    return response()->json($array,400);
        }
        $fecha = Carbon::now()->format('Y-m-d');
        $hora = Carbon::now()->format('H:i:s');

        ListaTareas::create([
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'autor' => $request->input('autor'),
            'fecha' => $fecha, 
            'hora' => $hora,    
        ]);
            $array=
                array
                (
                    'response'=>array
                    (
                        'estado' => 'OK',
                        'mensaje'=> 'Se creó el registro'
                    )
                    );
                    return response()->json($array,201);
            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datos = ListaTareas::where(['id'=>$id])->firstorfail();
        return response()->json($datos, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $json = json_decode(file_get_contents('php://input'), true);
        if (!is_array($json))
        {
            $array=
                array
                (
                    'response'=>array
                    (
                        'estado' => 'Bad Request',
                        'mensaje'=> 'La petición HTTP no trae datos'
                    )
                    );
                    return response()->json($array,400);
        }
        
        $fecha = Carbon::now()->format('Y-m-d');
        $hora = Carbon::now()->format('H:i:s');
        $datos = ListaTareas::where(['id'=>$id])->firstorfail();
        $datos->titulo=$request->input("titulo");
        $datos->descripcion=$request->input("descripcion");
        $datos->autor=$request->input("autor");
        $datos->fecha=$fecha;
        $datos->hora=$hora;
        $datos->save();
        
        
            $array=
                array
                (
                    'response'=>array
                    (
                        'estado' => 'OK',
                        'mensaje'=> 'Se creó el registro'
                    )
                    );
                    return response()->json($array,200);
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datos = ListaTareas::where(['id'=>$id])->firstorfail();
        if(ListaTareas::where(['id'=>$id])->count()==0)
        {
            $array=
                array
                (
                    'response'=>array
                    (
                        'estado' => 'mal',
                        'mensaje'=> 'no hay registro'
                    )
                    );
                    return response()->json($array,200);
        }
        else
        {
            $datos->delete();
            $array=
                array
                (
                    'response'=>array
                    (
                        'estado' => 'OK',
                        'mensaje'=> 'se eliminó el registro'
                    )
                    );
                    return response()->json($array,200);
        }
    }
}
