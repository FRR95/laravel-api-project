<?php

namespace App\Http\Controllers;

use App\Models\UserRoom;
use Illuminate\Http\Request;

class UserRoomController extends Controller
{
    public function getAllUsersFromRoomId($id)
    {
        try {
            $users = UserRoom::where('room_id', $id)
                ->with('user')
                ->get()
                ->pluck('user.name');

            return response()->json(
                [
                    'success' => true,
                    'message' => 'UsersRooms retrieved successfully',
                    'data' => $users
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'UsersRooms cant be retrieved',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function joinRoom(Request $request)
    {
        try {
            $userRoom = new UserRoom();

            $request->validate([
                'room_id' => 'required'
            ]);
            $userRoom->user_id = auth()->user()->id;
            $userRoom->room_id = $request->room_id;
            $userRoom->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Room joined successfully',
                    'data' => $userRoom
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cant join room',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function leaveRoomById($id)
    {
        try {
            $userRoom = UserRoom::where("room_id", $id)
                ->where("user_id", auth()->user()->id);

            if ($userRoom!=null) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Room not found',
                        'data' => null
                    ],
                    404
                );
            }

            $userRoom->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Room exited successfully',
                    'data' => $userRoom
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cant leave room',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
