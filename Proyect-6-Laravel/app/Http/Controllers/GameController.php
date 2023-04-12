<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function newGame(Request $request)
    {
        try {
            Log::info("New Game Working");
            $title = $request->input('title');
            $genre = $request->input('genre');
            $platform = $request->input('platform');
            $newGame = new Game();
            $newGame->title = $title;
            $newGame->genre = $genre;
            $newGame->platform = $platform;
            $newGame->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Party Created",
                    "data" => $newGame
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("New Game error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }
}
