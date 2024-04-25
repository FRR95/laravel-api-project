<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function getAllRooms()
    {
        try {

            $allRooms = Room::all();

            if ($allRooms->count() === 0) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'No Rooms to call!'
                    ]
                );
            }

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

    public function getAllRoomsByGame($gameName)
    {

        try {
            $game = Game::where("name", $gameName)
                ->first();

            $rooms = Room::where("game_id", $game->id)
                ->get();

            // dd($rooms->name);
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Game rooms retrieved successfully',
                    'data' => $rooms
                ],
                200);
        } catch (\Throwable $th) {
            
            return response()->json(
                [
                    'success' => false,
                    'message' => 'ERROR',
                    'data' => $th->getMessage()()
                ],
                500);
        }
    }

    public function createNewRoom(Request $request)
    {
        try {

            $user = auth()->user();

            $name = $request->input('name');
            $description = $request->input('description');
            $game_id = $request->input('game_id');
            $user_id = $user->id;

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'game_id' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'name or game invalid'
                    ]
                );
            }

            $rooms = Room::query()
                ->where('game_id', $game_id)
                ->get();

            foreach ($rooms as $room) {
                if ($room->user_id === $user->id) {
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'You already have a room with this game!'
                        ]
                    );
                }
            }

            $newRoom = new Room;

            $newRoom->name = $request->name;
            $newRoom->description = $request->description;
            $newRoom->game_id = $request->game_id;
            $newRoom->user_id = $user->id;

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

            if (!$updatedRoom) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Room doesn't exist!"
                    ]
                );
            }

            $RoomName = $request->input('name');
            $RoomDescription = $request->input('description');
            $RoomGameId = $request->input('game_id');

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

            $user = auth()->user();

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

            if ($deletedRoom->user_id !== $user->id) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "You're not the administrator of this room!"
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
