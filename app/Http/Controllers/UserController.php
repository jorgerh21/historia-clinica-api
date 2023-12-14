<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
	public function index(){
		$users = User::all();
		return Response()->json($users);
	}
	
	public function mostrarUsuario($id){
		$user = User::find($id);
		return Response()->json($user);
	}

	public function listaPacientes(){
		$users = User::where('tipo_usuario_id',2)->get();;
		return Response()->json($users);
	}

    public function password(Request $request,$id)
    {
        if(User::find($id)->exists()){
		$usuario = User::find($id);	
		$usuario->password = $request->password;
		$usuario->primer = 1;
		
		$usuario->save();
		return response()->json([
		"message"=>"usuario Actualizado"], 201);
		}else{
			return response()->json(["message"=>"usuario no encontrado"],404);
		}
		
    }

    public function updateUser(Request $request,$id)
    {
        if(User::find($id)->exists()){
		$usuario = User::find($id);	
		$usuario->name = is_null($request->name)? $usuario->name : $request->name;
		$usuario->apellido = is_null($request->apellido)? $usuario->apellido : $request->apellido;
		$usuario->identificacion = is_null($request->identificacion)? $usuario->identificacion : $request->identificacion;
        $usuario->email = is_null($request->email)? $usuario->email : $request->email;
        $usuario->celular = is_null($request->celular)? $usuario->celular : $request->celular;
        $usuario->ubicacion = is_null($request->ubicacion)? $usuario->ubicacion : $request->ubicacion;
        $usuario->password = is_null($request->password)? $usuario->password : $request->password;
			
		$usuario->save();
		return response()->json([
		"message"=>"usuario Actualizado"], 201);
		}else{
			return response()->json(["message"=>"usuario no encontrado"],404);
		}
		
    }
	
	public function __construct()
    {
        //$this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|string',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('identificacion', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'user' => $user,
                'authorization' => [
                    'token' => $user->createToken('ApiToken')->plainTextToken,
                    'type' => 'bearer',
                ]
            ]);
        }

        return response()->json([
            'message' => 'credenciales incorrectas',
        ], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
			'apellido' => 'required|string|max:255',
			'identificacion' => 'required|max:255|unique:users',
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
			'identificacion' => $request->identificacion,
			'email' => $request->email,
			'tipo_usuario_id' => $request->tipoUsuario,
			'celular' => $request->celular,
			'ubicacion' => $request->ubicacion,
            'password' => Hash::make($request->identificacion),
        ]);

        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'user' => $user
        ]);
    }


    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
