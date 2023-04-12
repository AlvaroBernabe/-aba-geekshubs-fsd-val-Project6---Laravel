<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Party;
use App\Models\Party_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                    "message" => "Error creating Party" . $newParty
                ],
                500
            );
        }
    }



    public function getPartyById(Request $request, $id)
    {
        try {
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
            Log::error("Error Joining to Party " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "The party does not Exist"
                ],
                500
            );
        }
    }


    public function leaveParty(Request $request, $id)
    {
        try {
            $myId = auth()->user()->id;
            $user = User::find($myId);
            $userID = $user->id;

            $partyLeave= DB::table('party_user')->where('id', '=', $id)->find($id);
            $party_userID = $partyLeave->user_id;
            if ($party_userID == $userID) {
                // Party_User::destroy($id);
                echo($userID.'hola mundo');
                $partyDelete= DB::table('party_user')->where('id', '=', $id)->delete($id);
                $partyDelete;
                // return response()->json([
                //     'success' => true,
                //     'message' => 'sucessfully exited the party',
                // ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "You are not in the party",
                ]);
            }
        } catch (\Throwable $th) {
            Log::error("Error Leaving the Party " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    // "message" => "NOT Exited the party",
                    "message" => $userID
                ],
                500
            );
        }
    }


}
