<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMetadata;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class apiAccesoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic');
    }
   public function index()
   {

   }

   
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
        $users = User::where(['email'=>$request->input('correo')])->first();
        if(!is_object($users))
        {
            $array=
            array
            (
                'response'=>array
                (
                    'estado' => 'Bad Request',
                    'mensaje'=> 'Las credenciales no son válidas'
                )
                );
                return response()->json($array,400);
        }
        $users_metadata=UserMetadata::where(['users_id'=>$users->id])->first();
        if(!is_object($users_metadata))
        {
            $array=
            array
            (
                'response'=>array
                (
                    'estado' => 'Bad Request',
                    'mensaje'=> 'Las credenciales no son válidas'
                )
                );
                return response()->json($array,400);
        }
    
    if(!Auth::attempt(['email' => $request->input('correo'),'password'=>$request->input('password')]))
    {
        $array=
        array
        (
            'response'=>array
            (
                'estado' => 'Bad Request',
                'mensaje'=> 'Las credenciales no son válidas'
            )
            );
            return response()->json($array,400);
    }
    $fecha = time();
    $payload = ['id'=>$users_metadata->id,
                'iat'=>$fecha];
    $jwt = JWT::encode($payload, env('SECRETO'), 'HS256');
    $array=
    array
    (
        'response'=>array
        (
            'estado' => 'Ok',
            'nombre'=>$users->name,
            'token'=> $jwt
        )
        );
        return response()->json($array,200);
}

}
