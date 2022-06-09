<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\GetUserRequest;
use App\Http\Requests\InsertUserRequest;
use App\Models\Reviewer;

class ReviewersController extends Controller
{
    public function insertUser(InsertUserRequest $request)
    {
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
        if (Reviewer::find($request->userId)) {
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
        }
        return response()->json([
            'userId' => null,
            'username' => null,
            'option' => 'delete',
            'status' => 'error'
        ]);
    }

    public function getAllUsers()
    {
        return response()->json(Reviewer::all());
    }

    public function getUser(GetUserRequest $query)
    {
        if (Reviewer::find($query->userId)) {
            return response()->json([
                'userId' => Reviewer::find($query->userId)::first()->id,
                'username' => Reviewer::find($query->userId)::first()->username,
                'option' => 'get',
                'status' => 'success'
            ]);
        }
        return response()->json([
            'userId' => null,
            'username' => null,
            'option' => 'get',
            'status' => 'error'
        ]);
    }
}
