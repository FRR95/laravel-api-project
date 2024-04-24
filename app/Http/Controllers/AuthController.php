<?php

namespace App\Http\Controllers;

use App\Models\User;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $name = $request->input('name');
            $role_id = $request->input('role_id');
            $password = $request->input('password');
            $email = $request->input('email');

            //Validar

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'password' => 'required|min:4|max:10',
                'email' => 'required|unique:users'
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error during register",
                        "error" => $validator
                    ],
                    400
                );
            }

            $hashPassword = bcrypt($password);

            $newUser = new User;
            $newUser->name = $name;
            $newUser->password = $hashPassword;
            $newUser->email = $email;
            $newUser->role_id = $role_id;

            $newUser->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "User registered successfully",
                    "data" => $newUser
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "User cant be registered",
                    "error" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function login(Request $request)
    {
        try {

            $email = $request->input('email');
            $password = $request->input('password');


            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required'

            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error during login",
                        "error" => $validator
                    ],
                    400
                );
            }

            $user = User::query()
                ->where('email', $email)
                ->first();

            if (!$user) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password not valid",
                        // "error" => $th->getMessage()
                    ],
                    400
                );
            }

            $checkPasswordUser = Hash::check($password, $user->password);

            if (!$checkPasswordUser) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password not valid 2",
                        // "error" => $th->getMessage()
                    ],
                    400
                );
            }
            $token = $user->createToken('api-token')->plainTextToken;


            return response()->json(
                [
                    "success" => true,
                    "message" => "user logged",
                    "token" => $token
                ],
                200
            );
        } catch (\Throwable $th) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "User cant be logged",
                    "error" => $th->getMessage()
                ],
                500
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
