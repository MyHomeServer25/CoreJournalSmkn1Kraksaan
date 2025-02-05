<?php
namespace App\Http\Controllers\Api\auth;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __invoke(StoreLoginRequest $request)
    {
        // Get credentials from request
        $credentials = $request->only('email', 'password');

        // If auth failed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        // Get authenticated user
        $user = auth()->guard('api')->user();

        // If auth success
        return response()->json([
            'success' => true,
            'user'    => $user,    
            'token'   => $token,
            // 'redirect' => $redirectRoute
        ], 200);
    }
}