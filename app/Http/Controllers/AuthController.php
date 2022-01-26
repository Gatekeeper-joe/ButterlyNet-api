<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\halfWidth;
use Illuminate\Http\JsonResponse;
use Log;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    public function login(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nickname' => ['required', 'max:30'],
                'password' => ['required', new halfWidth, 'between:8,30', 'regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!#$%])/']
            ],
        );

        if ($validator->fails()) {
            return new JsonResponse($validator->errors());
        }

        if (!$token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $newToken =  $this->createNewToken($token);

        return $newToken;
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(User $user)
    {
        $user_id = Auth::id();
        $flag = 0;
        auth()->logout();
        $user->saveNow($user_id, $flag);
        return;
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth('api')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(User $user)
    {
        // return response()->json(auth()->user());
        $user_id = Auth::id();
        $flag = 1;
        $user->saveNow($user_id, $flag);
        $user = User::find($user_id);
        $user->links = json_decode($user->links, 1);
        return response()->json($user);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
