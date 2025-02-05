<?php
namespace App\Http\Controllers\Api\auth;

use App\Models\User;
use App\Enums\RoleEnum;
use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(StoreRegisterRequest $request)
    {
        //create user
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role'  => $request->role ?? RoleEnum::STUDENT->value
        ]);

        Student::create([
            'nisn' => $request->nisn,
            'name' => $user->name,
            'users_id' => $user->id
        ]);

        //return response JSON user is created
        if($user) {
            return response()->json([
                'success' => true,
                'user'    => $user,  
            ], 201);
        }

        //return JSON process insert failed 
        return response()->json([
            'success' => false,
            'errors' => ['message' => 'Registration failed']
        ], 409);
    }
}