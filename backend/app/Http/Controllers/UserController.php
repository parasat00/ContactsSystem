<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class UserController extends Controller
{
    public function show(): JsonResponse
    {
        $user = Auth::user();
        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'User not authenticated'
        ], 401);
    }

    public function update(EditUserRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $user = Auth::user();

            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User was updated successfully',
                'user' => $user
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update contact: ' . $exception->getMessage(),
                'error' => $exception->getCode()
            ], 500);
        }
    }
}
