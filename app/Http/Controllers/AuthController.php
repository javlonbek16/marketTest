<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthValidation;
use App\Http\Requests\AuthValidationL;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(AuthValidation $request)
    {
        $user = User::create([

            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password'))

        ]);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'Foydalanuvchi muvaffaqiyatli ro\'yxatdan o\'tdi']);
    }

    public function login(AuthValidationL $request)
    {
        $user = User::where('username', $request->input('username'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password))

            throw ValidationException::withMessages(['username' => 'Hisob maʼlumotlari yaroqsiz']);

        $token = $user->createToken('auth-token', ['role' => $user->role])->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'Kirish muvaffaqiyatli bo\'ldi']);
    }
}
