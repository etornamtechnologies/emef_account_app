<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $res = [];
        $user = User::where('username', $request->username)
            ->where('password', bcrypt($request->password))->first();
        if(!$user) {
            $res['code'] = 401;
            $res['message'] = 'Invalid credentials';
        } else {
            $res['code'] = 200;
            $res['message'] = 'success';
        }
        
        return resposne()->json($res);
    }

    public function logout(Request $request)
    {
        $res = [];
        try{
            $api_token = $request->api_token;
            $user = User::where('api_token', $api_token)->first();
            if(!$user) {
                $res['code'] = 401;
                $res['message'] = 'Not Logged in';
            }
            $user->api_token = null;
            $user->save();
            $res['code'] = 200;
            $res['message'] = 'Logged out successful';
        } catch(Exception $e) {
            $res['code'] = 500;
            $res['message'] = 'Server error';
        }
        return response()->json($res);
    }

    public function register(Request $request)
    {
        try {
            $user = User::create([
                'username'=> $request->username,
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'password'=> bcrypt($request->password),
                'api_token'=> str_random(50)
            ]);
            return response()->json(['user'=> $user, 'code'=> 200]);
        } catch(Exception $e) {
            return response()->json(['code'=>500, 'message'=>'Server error']);
        }
    }
}
