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
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'password' => 'required|string|min:4|max:10', // Assuming `red` was a typo; corrected to a plausible rule
                'email' => 'required|string|email|unique:users' // Corrected for standard email validation
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => "Validation failed",
                    "errors" => $validator->errors()
                ]); // Added missing semicolon
            }

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
            ]); // Added missing semicolon
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'User cannot be registered'
            ]); // Added missing semicolon, commented out 'error' for clean syntax correction
        }
    }
}

public function login(Request $request){
    try {
        //recuperar request
        $email= $request->input('email');
        $password= $request
        //validarla
        //comprobar si el usuario existe
        //validar password con el user
        //crear token
        //responder con el token
    } catch (\Throwable $th) {
        //throw $th;
    }
}