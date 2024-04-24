<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Recuperar datos
            $name = $request->input('name');
            $password = $request->input('password');
            $email = $request->input('email');

            // Validar 
           $validator = Validator::make($request->all(),[
            'name'=>'required'
            'password'=> 'required|red|min:4|max:10'
            'email'=> 'required|unique:users'
           ])

            // Tratar info
            $hashPassword = bcrypt($password);

            // Guardar en db
            $newUser = new User();
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->password = $hashPassword;
            $newUser->save();

            // Devolver respuesta
            return response()->json([
                'success' => true,
                'message' => 'User registered',
                'data' => $newUser
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'User cannot be registered',
                // 'error' => $th->getMessage()
            ]);
        }
    }
}
