<?php

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{

    public function updateprofile(Request $request)
    { {
            try {
                Log::info("Update Profile Working");
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
                        "message" => $th->getMessage()
                    ],
                    500
                );
            }
        }
    }

    public function myProfile()
    {
        try {
            Log::info("Get My Profile Working");
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
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function getAllUsers()
    {
        try {
            Log::info("Get All Users Working");
            $users = User::query()->get();
            return [
                "success" => true,
                "data" => $users
            ];
        } catch (\Throwable $th) {
            Log::error("Get All Users error: " . $th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function getUserDetailsById(Request $request, $id)
    {
        try {
            Log::info("Get User Details By Id Working");
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
            Log::error("Get User Details By Id error: " . $th->getMessage());
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
            Log::info("Delete User By Id Working");
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
            Log::error("Delete User By Id error: " . $th->getMessage());
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
