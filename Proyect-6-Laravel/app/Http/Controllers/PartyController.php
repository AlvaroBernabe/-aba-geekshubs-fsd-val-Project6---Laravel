<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Party;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PartyController extends Controller
{

    public function createParty(Request $request)
    {
        try {
            Log::info("Creating Party Working");
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
            Log::error("Creating Party error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }



    public function getPartyById(Request $request, $id)
    {
        try {
            Log::info("Get Party By Id Working");
            $party = Party::query()->find($id);
            $gameId = $party->game_id;
            $gameData = Game::query()->find($gameId);
            $gameTitle = $gameData->title;
            return response()->json(
                [
                    "success" => true,
                    "message" => "Party Details",
                    "data" => [
                        'id' => $party->id,
                        'name' => $party->name,
                        'rules' => $party->rules,
                        'Title of Game' => $gameTitle,
                        'game_id' => $party->game_id,
                    ]
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("Get Party By Id Error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function joinParty(Request $request)
    {
        try {
            Log::info("Join Party Working");
            $party_id = $request->input('party_id');
            $myId = auth()->user()->id;
            $user = User::find($myId);
            $party = Party::find($party_id);
            $party_userID = $party->users()->find($myId);
            if ($party_userID && $user) {
                return response()->json([
                    'success' => true,
                    'message' => "You are already in the party",
                ]);
            } else {
                $partyJoin = DB::table('party_user')->insert(
                    [
                        'party_id' => $party_id,
                        'user_id' => $myId,
                    ]
                );
                return response()->json([
                    "success" => true,
                    "message" => "Joined to Party Correctly",
                    "data" => $partyJoin
                ], 200);
            }
        } catch (\Throwable $th) {
            Log::error("Join Party error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function leaveParty(Request $request, $id)
    {
        try {
            Log::info("Leave Party Working");
            $myId = auth()->user()->id;
            $user = User::find($myId);
            $userID = $user->id;
            $partyLeave = DB::table('party_user')->where('id', '=', $id)->find($id);
            $party_userID = $partyLeave->user_id;
            if ($party_userID == $userID) {
                echo ($userID . 'hola mundo');
                $partyDelete = DB::table('party_user')->where('id', '=', $id)->delete($id);
                $partyDelete;
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "You are not in the party",
                ]);
            }
        } catch (\Throwable $th) {
            Log::error("Leave Party error: " . $th->getMessage());
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
