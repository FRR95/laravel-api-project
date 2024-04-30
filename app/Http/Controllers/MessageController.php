<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\UserRoom;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getAllMessagesFromRoomById($id)
    {
        try {
            // $messages = Message::all();
            $roomId = $id;
            $mymessages = Message::query()
            ->where('room_id', $roomId)
            ->get();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Messages retrieved successfully",
                    "data" => $mymessages       
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
            $message->user_id =  auth()->user()->id;
            $message->room_id = $request->input('room_id');

            $userroom = UserRoom::where("user_id", auth()->user()->id)
                                ->where("room_id", $request->input('room_id'))
                                ->first();

            if($userroom !== null){
                $message->save();
            } else {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "You are not allowed to send messages in this room",
                    ],
                    500
                );
            }
            
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

            if(!$message){
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Message not found",
                        
                    ],
                    400
                );


            }
            
            $messageUser=Message::where("id",$messageId)
                                ->where("user_id",auth()->user()->id);

            if($messageUser->count() === 0){
                return response()->json(
                    [
                        "success" => false,
                        "message" => "You cannot update this message because you are not the owner",
                    ],
                    400
                );
            }
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


    public function deleteMessageById($id)
    {
        try {
            $messageDeleted = Message::destroy($id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Message deleted successfully",
                    "data" => $messageDeleted      
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Message cant be deleted",
                    "error" => $th->getMessage()
                ],
                500
            );
        }
    }
}
