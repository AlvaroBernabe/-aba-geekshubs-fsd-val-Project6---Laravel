<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Message;
use App\Models\Party;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class MessageController extends Controller
{
    public function getAllMessages()
    {
        try {
            Log::info("Get All Messages Working");
            $messages = Message::query()->get;
            return [
                "success" => true,
                "data" => $messages
            ];
        } catch (\Throwable $th) {
            Log::error("Get All Messages Error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function newMessage(Request $request)
    {
        try {
            Log::info("New Messages Working");
            $validator = Validator::make($request->all(), [
                'comments' => 'string',
                'party_id' => 'integer',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $userId = auth()->user()->id;
            $party_id = $request->input('party_id');
            $comments = $request->input('comments');
            $newMessage = new Message();
            $newMessage->party_id = $party_id;
            $newMessage->user_id = $userId;
            $newMessage->comments = $comments;
            $newMessage->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Review Created",
                    "data" => $newMessage
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("New Messages Error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function getMyMessages()
    {
        Log::info("Get User Message Working");
        try {
            $id = auth()->user()->id;
            $message = DB::table('messages')->where('user_id', '=', $id)->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Estos son todos sus mensajes",
                    "data" => $message
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("Get User Message Error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function getMessagesByPartyId($id)
    {
        try {
            Log::info("Get Message By Party ID Working");
            $message = DB::table('messages')->where('party_id', '=', $id)->get();
            $party = Party::query()->find($id);
            $gameId = $party->game_id;
            $gameId = $party->game_id;
            $gameData = Game::query()->find($gameId);
            $gameTitle = $gameData->title;
            return response()->json(
                [
                    "success" => true,
                    "message" => "Message of Games Id",
                    "data" => [
                        'Title of Game' => $gameTitle,
                        'Message' =>  $message
                    ]
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error("Get User Message Error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function deleteMessageByIdAdmin(Request $request, $id)
    {
        try {
            Log::info("Delete Message By Id Admin Working");
            Message::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Message successfully deleted',
            ], 200);
        } catch (\Throwable $th) {
            Log::error("Delete Message By Id Admin Error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function deleteMessageByIdUser(Request $request, $id)
    {
        try {
            Log::info("Delete Message By Id User Working");
            $myId = auth()->user()->id;
            $user = User::find($myId);
            $party = Message::find($id);
            if ($user->id == $party->user_id) {
                Message::where('id', $id)->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Message successfully deleted',
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "You cant delete Other People Messages ",
                ]);
            }
        } catch (\Throwable $th) {
            Log::error("Delete Message By Id User error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function updateMessaggesByIdAdmin(Request $request, $id)
    { {
            try {
                Log::info("Update Message By Id Admin Working");
                $validator = Validator::make($request->all(), [
                    'comments' => 'string',
                    'party_id' => 'integer',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
                $comments = $request->input('comments');
                $party_id = $request->input('party_id');
                $message = Message::find($id);
                if (isNull($comments, $party_id)) {
                    $message->comments = $comments;
                    $message->party_id = $party_id;
                }
                $message->save();
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Profile Updated Correctly",
                        "data" => $message
                    ],
                    200
                );
            } catch (\Throwable $th) {
                Log::error("Update Message By Id Admin Error: " . $th->getMessage());
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

    public function updateUserMessageById(Request $request, $id)
    { {
            try {
                Log::info("Update User Message By Id Working");
                $validator = Validator::make($request->all(), [
                    'comments' => 'string',
                    'party_id' => 'integer',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
                $comments = $request->input('comments');
                $party_id = $request->input('party_id');
                $message = Message::find($id);
                $myId = auth()->user()->id;
                $user = User::find($myId);
                if ($user->id == $message->user_id) {
                    $message->comments = $comments;
                    $message->party_id = $party_id;
                    $message->save();
                    return response()->json(
                        [
                            "success" => true,
                            "message" => "Message Updated Correctly",
                            "data" => $message
                        ],
                        200
                    );
                } else {
                    return response()->json([
                        'success' => true,
                        'message' => "You cant update Other People Messages ",
                    ]);
                }
            } catch (\Throwable $th) {
                Log::error("Update User Message By Id error: " . $th->getMessage());
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Update User Message By Id error "
                    ],
                    500
                );
            }
        }
    }
}
