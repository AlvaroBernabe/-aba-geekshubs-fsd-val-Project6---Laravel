<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{

    public function createParty(Request $request)
    {
        try {
            $game_id = $request->input('game_id');
            $rules = $request->input('rules');
            $name = $request->input('name');

            $newParty = new Party();
            $newParty->game_id = $game_id;
            $newParty->name = $name;
            $newParty->rules = $rules;
            $newParty->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Party Created",
                    "data" => $newParty
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("Creating Party Error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating Party".$newParty
                ],
                500
            );
        }
    }


}
