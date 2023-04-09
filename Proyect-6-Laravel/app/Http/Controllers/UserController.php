<?php

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    
    public function updateprofile(Request $request, $id){
    {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => 'regex:/^[A-Za-z0-9]+$/',
                    'surname' => 'required|string',
                    'nickname' => 'required|string',
                    'phone_number' => 'required|integer',
                    'direction' => 'required|string',
                    'age' => 'required|string',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
                $user = User::find($id);
                if (!$user) {
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
            

            if (isset($name, $surname, $nickname, $phone_number, $direction, $age)) {
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
                    "message" => "Update Profile error"
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
}
