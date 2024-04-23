<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function getAllRooms()
    {
        try {

            $allRooms = Room::all();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'All Rooms called succesfully!',
                    'data' => $allRooms
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'CANNOT CALL ALL ROOMS',
                    'data' => $th->getMessage()()
                ],
                500
            );
        }
    }

    public function createNewRoom(Request $request)
    {
        try {

            $newRoom = new Room;

            $newRoom->name = $request->name;
            $newRoom->description = $request->description;
            $newRoom->game_id = $request->game_id;
            $newRoom->user_id = $request->user_id;

            $newRoom->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Room succesfully created!',
                    'data' => $newRoom
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'CANNOT CALL ALL ROOMS',
                    'data' => $th->getMessage()()
                ],
                500
            );
        }
    }

    public function updateRoom(Request $request, $id)
    {
        try {

            $updatedRoom = Room::find($id);

            $RoomName = $request->name;
            $RoomDescription = $request->description;
            $RoomGameId = $request->game_id;

            if ($RoomName) {
                $updatedRoom->name = $RoomName;
            }
            if ($RoomDescription) {
                $updatedRoom->description = $RoomDescription;
            }
            if ($RoomGameId) {
                $updatedRoom->game_id = $RoomGameId;
            }

            $updatedRoom->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Room succesfully updated!',
                    'data' => $updatedRoom
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'CANNOT CALL ALL ROOMS',
                    'data' => $th->getMessage()()
                ],
                500
            );
        }
    }

    public function deleteRoom($id)
    {
        try {

            // $deletedRoom = Room::destroy($id);
            $deletedRoom = Room::find($id);

            if (!$deletedRoom) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Room doesn't exist!",
                    ]
                );
            }

            $deletedRoom->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Room succesfully deleted!'
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'CANNOT DELETE ROOM',
                    'data' => $th->getMessage()
                ]
            );
        }
    }
}
