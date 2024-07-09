<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email'     =>'required|email',
                'password'  =>'required|min:8',
            ]);
            
            if ($validator->fails()){
                return response()->json([
                    "status"    =>"failed",
                    "message"   => $validator->errors()->all(),
                    "data"      =>[],
                ], 422);
            }
            $user = UserModel::where('email', $request->email)->where('password', $request->password)->first();
            
            if ($user != null){
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    "status"    =>"success",
                    "message"   => "Login Berhasil",
                    "data"      =>[
                        'user'  => $user,
                        'token' => $token,
                    ],
                ], 200);
            } else {
                return response()->json([
                    "status"    =>"failed",
                    "message"   => "Data tidak ditemukan",
                    "data"      =>[],
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status"    =>"failed",
                "message"   => $th,
                "data"      =>[],
            ], 500);
        }
    }
    
    /*public function register(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
            'password'  => 'required|min:8',
        ]);

        $user = User::create($data);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password'  => 'required|min:8',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }*/
}
