<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            $validator = Validator::make($request->all(), [ //validator facades
                'name' => 'required',
                'password' => 'required|string|min:4|max:10', 
                'email' => 'required|string|email|unique:users' 
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => "Validation failed",
                    "errors" => $validator->errors()
                ]); 
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
            ]); 
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'User cannot be registered'
            ]); 
        }
    }

    public function login(Request $request) {
        try {
            // recuperar la request
            $email = $request->input('email');
            $password = $request->input('password');

               // Validarla
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'email' => 'required'
            ]);
     
            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Validation failed",
                        "error" => $validator->errors()
                    ]
                );
            }

            // Comprobar si el usuario existe
            $user = User::query()
                ->where('email', $email)
                ->first();

            if(!$user) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password not valid",
                        
                    ],
                    400
                );
            }

            // Validar password con el usuario
            $checkPasswordUser = Hash::check($password, $user->password);
            
            if(!$checkPasswordUser) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password not valid 2",
                        
                    ],
                    400
                );
            }
            
            // Crear token
            $token =$user->createToken('api-token')->plainTextToken;

            // Responder con el token
            return response()->json(
                [
                    "success" => true,
                    "message" => "user logged",
                    "token" => $token
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "user cant be logged",
                    // "error" => $th->getMessage()
                ]
            );
        }
    }

    public function getProfile()
    {
        $user = auth()->user();

        return response()->json(
            [
                "success" => true,
                "message" => "user profile retrieved",
                "data" => $user
            ]
        );
    }
}