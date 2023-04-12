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
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isNull;

class MessageController extends Controller
{
    public function getAllMessages()
    {
        // ToDo manejo de errores
        $messages = Message::query()->get;
        return [
            "success" => true,
            "data" => $messages
        ];
    }

    public function newMessage(Request $request)
    {
        try {

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
            Log::error("Creating Review Error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating Review"
                ],
                500
            );
        }
    }

    public function getMyMessages()
    {
        try {
            $id = auth()->user()->id;
            $message = DB::table('messages')->where('user_id', '=', $id)->get();
            // $message->user_id = $user_id;
            // $message->comments = $comments;
            // $message->party_id = $party_id;
            // $message->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Estos son todos sus mensajes",
                    "data" => $message
                    // "data" => [
                    //     'id' => $message->data->id,
                    //     'user_id' => $message->data->user_id,
                    //     'comments' => $message->data->comments,
                    //     'party_id' => $message->data->party_id,
                    // ]
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage() . $message
                ],
                500
            );
        }
    }

    public function getMessagesByPartyId($id)
    {
        try {
            $message = DB::table('messages')->where('party_id', '=', $id)->get();
            // $messageUsername = $message->user_id;
            // $messageUsername = $message['id']->get();
            // $messageUsername = $message->first()->get();
            // $messageContent = $message->comments;
            // $message = Message::query()->where('party_id', $id);
            // $userID = $message->user_id;
            $party = Party::query()->find($id);
            $gameId = $party->game_id;
            $partyName = $party->name;
            $gameId = $party->game_id;
            // $gameData = DB::table('games')->where('id', '=', $gameId)->get();
            $gameData = Game::query()->find($gameId);
            $gameTitle = $gameData->title;
            // $UserName = DB::table('users')->where('id', '=', $message->user_id)->get();
            // $userData = User::query()->fing($userID);
            // $userNick = $userData->nickname;
            // $gameName = $gameData->title;

            return response()->json(
                [
                    "success" => true,
                    "message" => "Message of Games Id",
                    "data" => [
                        'Title of Game' => $gameTitle,
                        // 'User Name' => $userNick,
                        'Message' =>  $message
                        ]
                    ],
                    200
                );
            } catch (\Throwable $th) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $th->getMessage().'testo es esto'.$message
                    ],
                    500
                );
            }
        }

        
        public function deleteMessageByIdAdmin(Request $request, $id)
        {
            try {
            Message::destroy($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Message successfully deleted',
                ], 200);
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

        
        public function deleteMessageByIdUser(Request $request, $id)
        {
            try {               
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
                return response()->json(
                    [
                        "success" => false,
                        "message" => $th->getMessage()
                    ],
                    500
                );
            }
        }

        public function updateMessaggesByIdAdmin(Request $request, $id){
            {
                    try {
                        // $id2 = DB::table('users')->where('id', '=', $id)->get();
                        $validator = Validator::make($request->all(), [
                            'comments' => 'string',
                            'party_id' => 'integer',
                        ]);
                        if ($validator->fails()) {
                            return response()->json($validator->errors(), 400);
                        }
                    // $message = DB::table('messages')->where('id', '=', $id)->get();
    
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
                        Log::error("Update Profile error: " . $th->getMessage());
                        return response()->json(
                            [
                                "success" => false,
                                "message" => "Update Profile error ". ($message)
                            ],
                            Response::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }
                }
            }
    
            public function updateUserMessageById(Request $request, $id){
                {
                        try {
                            
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
                        if ($user->id == $message->user_id ) {
                            $message->comments = $comments;
                            $message->party_id = $party_id;
                            $message->save();
                            return response()->json(
                                [
                                    "success" => true,
                                    "message" => "Message Updated Correctly",
                                    "data" => $message
                                ], 200);
                        } else {
                            return response()->json([
                                'success' => true,
                                'message' => "You cant update Other People Messages ",
                            ]);
                        }   
                        } catch (\Throwable $th) {
                            Log::error("Delete Message By Id User error: " . $th->getMessage());
                            return response()->json(
                                [
                                    "success" => false,
                                    "message" => "Delete Message By Id User error ". ($message)
                                ],
                                Response::HTTP_INTERNAL_SERVER_ERROR
                            );
                        }
                    }
                }


}
