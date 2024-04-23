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

    public function createMessage(Request $request)
    {
        try {
            $message = new Message;
            $message->text = $request->input('text');
            $message->user_id = $request->input('user_id');
            $message->room_id = $request->input('room_id');


            $message->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Message created successfully",
                    "data" => $message      
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Message cant be created",
                    "error" => $th->getMessage()
                ],
                500
            );
        }

    }

    public function updateMessageById(Request $request, $id)
    {
        try {
            $messageId = $id;

            $messageText = $request->input('text');
     

            $message = Message::find($messageId);

            // validar que existe la tarea

            if( $messageText ){
                $message->text = $messageText;
            }

         

            $message->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Message updated successfully",
                    "data" => $message   
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Message cant be updated",
                    "error" => $th->getMessage()
                ],
                500
            );
        }
    }
}
