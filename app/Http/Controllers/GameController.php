<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function getAllGames()
    {
        try {
            $games = Game::all();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Games retrieved successfully',
                    'data' => $games
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Games cant be retrieved',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function createGame(Request $request)
    {
        try {
            $game = new Game();

            $request->validate([
                'name' => 'required|max:50',
                'description' => 'required|max:150',
                'url_image' => 'required|max:150'
            ]);
            $game->name = $request->name;
            $game->description = $request->description;
            $game->url_image = $request->url_image;
            $game->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Game created successfully',
                    'data' => $game
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Game cant be created',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateGameById($id, Request $request)
    {
        try {
            $game = Game::find($id);

            if (!$game) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Game not found',
                        'data' => null
                    ], 404
                );
            }
            
            $request->validate([
                'name' => 'max:50',
                'description' => 'max:150',
                'url_image' => 'max:150'
            ]);
            
            if ($request->name) {
                $game->name = $request->name;
            }
            if ($request->description) {
                $game->description = $request->description;
            }
            if ($request->url_image) {
                $game->url_image = $request->url_image;
            }

            $game->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Game updated successfully',
                    'data' => $game
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Game cant be updated',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteGameById($id)
    {
        try {
            $game = Game::find($id);

            if (!$game) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Game not found',
                        'data' => null
                    ], 404
                );
            }
            $game->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Game deleted successfully',
                    'data' => $game
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Games cant be retrieved',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
