<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AuthController
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// User Controller
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/profile', [UserController::class, 'myProfile']);
    Route::put('/profile/update', [UserController::class, 'updateprofile']);
});

Route::group(['middleware' => ['auth:sanctum', 'isAdmin']], function () {
    Route::get('/users/all', [UserController::class, 'getAllUsers']);
    Route::get('/users/all/details/{id}', [UserController::class, 'getUserDetailsById']);
    Route::delete('/users/all/destroy/{id}', [UserController::class, 'deleteUserById']);
});

//Message Controller
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/comments/create', [MessageController::class, 'newMessage']);
    Route::get('/mycomments/view', [MessageController::class, 'getMyMessages']);
    Route::get('/comments/party/{id}', [MessageController::class, 'getMessagesByPartyId']);
    Route::put('/mycomments/update/{id}', [MessageController::class, 'updateUserMessageById']);
    Route::delete('/mycomments/destroy/{id}', [MessageController::class, 'deleteMessageByIdUser']);
});
Route::middleware('auth:sanctum', 'isAdmin')->delete('/comments/destroy/{id}', [MessageController::class, 'deleteMessageByIdAdmin']);
Route::middleware('auth:sanctum', 'isAdmin')->put('/comments/update/{id}', [MessageController::class, 'updateMessaggesByIdAdmin']);

//Party Controller
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/party/view/{id}', [PartyController::class, 'getPartyById']);
    Route::post('/party/join/', [PartyController::class, 'joinParty']);
    Route::delete('/party/leave/{id}', [PartyController::class, 'leaveParty']);
});
Route::middleware('auth:sanctum', 'isAdmin')->post('/party/create', [PartyController::class, 'createParty']);


//Game Controller
Route::middleware('auth:sanctum', 'isAdmin')->post('/game/create', [GameController::class, 'newGame']);



//Test
Route::get('/welcome', function () {
    return view('welcome');
});
