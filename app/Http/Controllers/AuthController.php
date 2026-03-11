<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register (Request $request) {
        $credentials = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed|min:8"
        ]);

        $user = User::create([
            "name" => $credentials["name"],
            "email" => $credentials["email"],
            "password" => Hash::make($credentials["password"])
        ]);

        return response()->json([
            "message" => "the user created successfully",
            "user" => $user
        ]);
    }

    public function login (Request $request) {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email", $credentials["email"])->first();

        if ($user && Hash::check($credentials["password"], $user->password)){
            $token = $user->createToken("api_token")->plainTextToken;

            return response()->json([
                "message" => "user logged in successfully !",
                "user" => $user,
                "token" => $token
            ]);
        }

        return response()->json([
            "error" => "wrong credentials !"
        ]);
    }
}
