<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function getAllRooms (){
        try {

            $allRooms = Room::all();
            
            return response()->json(
                [
                    'success'=>true,
                    'message'=> 'All Rooms called succesfully!',
                    'data'=> $allRooms
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success'=>false,
                    'message'=> 'CANNOT CALL ALL ROOMS',
                    'data'=> $th->getMessage()()
                ],
                500
            );
        }
    }

    public function createNewRoom(Request $request){
        try {

            $newRoom = new Room;

            $newRoom->title = $request-> title;
            


            return response()->json(
                [
                    'success'=>true,
                    'message'=> 'All Rooms called succesfully!',
                    // 'data'=> $allRooms
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success'=>false,
                    'message'=> 'CANNOT CALL ALL ROOMS',
                    'data'=> $th->getMessage()()
                ],
                500
            );        }
    }
}
