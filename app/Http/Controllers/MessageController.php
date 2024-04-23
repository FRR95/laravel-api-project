<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getAllMessages()
    {
        try {
            $messages = Message::all();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Messages retrieved successfully",
                    "data" => $messages       
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Messages cant be retrieved successfully",
                    "error" => $th->getMessage()
                ],
                500
            );
        }
    }
}
