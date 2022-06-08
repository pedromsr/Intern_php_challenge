<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\GetUserRequest;
use App\Http\Requests\InsertUserRequest;
use App\Models\Reviewer;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReviewersController extends Controller
{
    public function insertUser(InsertUserRequest $request)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        $user = new Reviewer();
        $user->username = $request->username;
        $user->save();

        return response()->json([
            'user' => $user->username,
            'option' => 'create',
            'status' => 'success'
        ]);
    }

    public function deleteUser(DeleteUserRequest $request)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        if (Reviewer::find($request->userId) != null) {
            $user = Reviewer::find($request->userId);

            $userId = $user->id;
            $username = $user->username;

            $user->forceDelete();

            return response()->json([
                'userId' => $userId,
                'username' => $username,
                'option' => 'delete',
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'userId' => null,
                'username' => null,
                'option' => 'delete',
                'status' => 'error'
            ]);
        }
    }

    public function getAllUsers()
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(Reviewer::all());
    }

    public function getUser(GetUserRequest $query)
    {
        try {
            JWTAuth::parseToken()->toUser();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        if (Reviewer::find($query->userId) != null) {
            return response()->json([
                'userId' => Reviewer::find($query->userId)::first()->id,
                'username' => Reviewer::find($query->userId)::first()->username,
                'option' => 'get',
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'userId' => null,
                'username' => null,
                'option' => 'get',
                'status' => 'error'
            ]);
        }
    }
}
