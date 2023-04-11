<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{

    public function updateprofile(Request $request){
    {
            try {
                $id = auth()->user()->id;
                $id2 = DB::table('users')->where('id', '=', $id)->get();
                $validator = Validator::make($request->all(), [
                    'name' => 'regex:/^[A-Za-z0-9]+$/',
                    'surname' => 'string',
                    'nickname' => 'string',
                    'phone_number' => 'integer',
                    'direction' => 'string',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
                $user = User::find($id);
                if (!$id2) {
                    return response()->json(
                        [
                            "success" => true,
                            "message" => "User doesn't exists",
                        ],
                        404
                    );
                }
            $name = $request->input('name');
            $surname = $request->input('surname');
            $nickname = $request->input('nickname');
            $phone_number = $request->input('phone_number');
            $direction = $request->input('direction');
            $age = $request->input('age');
            if (isNull($name, $surname, $nickname, $phone_number, $direction, $age)) {
                $user->name = $name;
                $user->surname = $surname;
                $user->nickname = $nickname;
                $user->phone_number = $phone_number;
                $user->direction = $direction;
                $user->age = $age;
            }
            $user->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Profile Updated Correctly",
                    "data" => $user
                ],
                200
            );
            } catch (\Throwable $th) {
                Log::error("Update Profile error: " . $th->getMessage());
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Update Profile error ". ($user)
                    ],
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }
    }

    public function myProfile()
    {
        try {
            $user = auth()->user();

            return response(
                [
                    "success" => true,
                    "message" => "User profile get succsessfully",
                    "data" => $user
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error("Get my Profile error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Cant Get my profile error"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function createComment(Request $request)
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




    public function getAllUsers()
    {
        try {
            $users = User::query()->get();
            return [
                "success" => true,
                "data" => $users
            ];
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage() . $users
                ],
                500
            );
        }
    }

    public function getUserDetailsById(Request $request, $id)
    {
        try {
            $users = User::query()->find($id);
            return response()->json(
                [
                    "success" => true,
                    "message" => "User Details",
                    "data" => [
                        'id' => $users->id,
                        'name' => $users->name,
                        'surname' => $users->surname,
                        'nickname' => $users->nickname,
                        'phone_number' => $users->phone_number,
                        'direction' => $users->direction,
                        'age' => $users->age,
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

        public function deleteUserById(Request $request, $id)
    {
        try {
        //     // $id = auth()->user()->id;
        //     $id2 = DB::table('users')->where('role_id', '=', 1)->get('role_id', '=', 1);
        //     // $userId = auth()->user();
        //     // $user = User::find($userId);
        //     $id2 = [
        //         'array' => 'integer'
        //         ];
        //     $test = (int)$id2;
        // //     if (sayHello() === FALSE)
        // //     echo "Function Failed";
        // // else
        // //     echo "Function Worked";
        // //     User::destroy($id) 

        //             if($test != 1) {
        //                 return response()->json([
        //                     'success' => true,
        //                     'message' => "You cant delete Yourself",
        //                     "message" => $test . "esto es test"
        //                 ]);
        //               } else {
        //                 User::destroy($id);
        //                 }
        //     return response()->json(
        //         [
        //             "success" => true,
        //             "message" => "User Deleted",
        //             "message" => $test . "esto es test"
        //         ],
        //         200
        //     );

        $user = User::find($id);
        if ($user->role_id != 1) {
            User::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'User successfully deleted',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You cant delete Yourself or Other Admin'
            ], 400);
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


}
