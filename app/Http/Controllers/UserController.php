<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use Illuminate\Http\Request;
use JWTAuth;
use JWTAuthException;

class UserController extends Controller
{
    //
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        $user = $this->user->create([
            'name'     => $request->name,
            'email'    => $request->email,
            'address'  => $request->address,
            'tel'      => $request->tel,
            'password' => Hash::make($request->get('password')),
        ]);
        return response()->json([
            'status'  => 200,
            'message' => 'User created successfully',
            'data'    => $user,
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token       = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid email or password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed to create token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getUserInfo(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
    public function editUser(Request $request)
    {
        $user           = JWTAuth::toUser($request->token);
        $user->name     = $request->name;
        $user->tel      = $request->tel;
        $user->address  = $request->address;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json($user);
    }
    public function logout(Request $request)
    {
        JWTAuth::invalidate($request->token);
        return response()->json("Successfully Logged Out");
    }

}
