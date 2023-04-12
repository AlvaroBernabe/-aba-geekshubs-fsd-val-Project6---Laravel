<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

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

    public function updateGame(Request $request, $id)
    {
        try {
            Log::info("Update Game by Id Admin Working");
            $title = $request->input('title');
            $genre = $request->input('genre');
            $platform = $request->input('platform');
            $gameUpdate = Game::find($id);
            if (IsNull($title, $genre, $platform)) {
                $gameUpdate->title = $title;
                $gameUpdate->genre = $genre;
                $gameUpdate->platform = $platform;
            }
            $gameUpdate->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Updated Game Correctly",
                    "data" => $gameUpdate
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("Update Game by Id Admin  Error: " . $th->getMessage());
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
