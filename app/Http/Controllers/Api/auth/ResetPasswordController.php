<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request to reset the password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        // Temukan pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        // Cek apakah password baru sama dengan password lama
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'password tidak boleh sama dengan password lama'
            ], 400);
        }

        // Update password pengguna
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Password berhasil direset'
        ], 200);
    }
}
