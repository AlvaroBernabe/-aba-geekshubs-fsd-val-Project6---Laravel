<?php

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    
    // public function profileUpdate(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string',
    //             'surname' => 'required|string',
    //             'nickname' => 'required|string',
    //             'phone_number' => 'required|integer',
    //             'direction' => 'required|string',
    //             'email' => 'required|string|unique:users,email',
    //             'age' => 'required|string',
    //             'password' => 'required|string|min:6|max:12'
    //         ]);
    //         if ($validator->fails()) {
    //             return response()->json($validator->errors(), 400);
    //         }
    //         $user = User::create([
    //             'name' => $request['name'],
    //             'surname' => $request['surname'],
    //             'nickname' => $request['nickname'],
    //             'phone_number' => $request['phone_number'],
    //             'direction' => $request['direction'],
    //             'email' => $request['email'],
    //             'age' => $request['age'],
    //             'password' => bcrypt($request['password']),
    //             'role_id' => 2,
    //         ]);
    //         $token = $user->createToken('apiToken')->plainTextToken;
    //         $res = [
    //             "success" => true,
    //             "message" => "User registered successfully",
    //             'data' => $user,
    //             "token" => $token
    //         ];
    //         return response()->json(
    //             $res,
    //             Response::HTTP_CREATED
    //         );
    //     } catch (\Throwable $th) {
    //         Log::error("Update Profile error: " . $th->getMessage());
    //         return response()->json(
    //             [
    //                 "success" => false,
    //                 "message" => "Register error"
    //             ],
    //             Response::HTTP_INTERNAL_SERVER_ERROR
    //         );
    //     }
    // }


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
