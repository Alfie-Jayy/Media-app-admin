<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //user Login
    public function userLogin(Request $req)
    {
        $user = User::where('email', $req->email)->first();

        if ($user) {

            if (Hash::check($req->password, $user->password)) {
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ]);
            } else {
                return response()->json([
                    'user' => null,
                    'token' => null
                ]);
            }
        } else {
            return response()->json([
                'user' => null,
                'token' => null
            ]);
        }
    }

    // user register
    public function userRegister(Request $req){
        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ];
        User::create($data);

        $user = User::where('email', $req->email)->first();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
        ]);
    }

}
