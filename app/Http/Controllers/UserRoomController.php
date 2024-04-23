<?php

namespace App\Http\Controllers;

use App\Models\UserRoom;
use Illuminate\Http\Request;

class UserRoomController extends Controller
{
    public function getAllUsersRooms()
    {
        try {
            $usersRooms = UserRoom::all();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'UsersRooms retrieved successfully',
                    'data' => $usersRooms
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'UsersRooms cant be retrieved',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function createUserRoom(Request $request)
    {
        try {
            $userRoom = new UserRoom();

            $request->validate([
                'user_id' => 'required',
                'room_id' => 'required'
            ]);
            $userRoom->user_id = $request->user_id;
            $userRoom->room_id = $request->room_id;
            $userRoom->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'UserRoom created successfully',
                    'data' => $userRoom
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'UserRoom cant be created',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteUserRoomById($id)
    {
        try {
            $userRoom = UserRoom::find($id);

            if (!$userRoom) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'userRoom not found',
                        'data' => null
                    ], 404
                );
            }
            $userRoom->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'UserRoom deleted successfully',
                    'data' => $userRoom
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'UserRoom cant be deleted',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
