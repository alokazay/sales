<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{


    public function createUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => 'false',
                'error' =>  $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 200);
        }

        $user = User::create([
            'role' => $request->role,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email
        ]);


        return response()->json([
            'success' => 'true',
            'token' => $user->createToken('Sales App')->plainTextToken
        ], 200);

    }

    public function loginUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => 'false',
                'error' =>  $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 200);
        }

        return response()->json([
            'success' => 'true',
            'token' => auth()->user()->createToken('Sales App')->plainTextToken
        ], 200);


    }

    public function logoutUser()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'success' => 'true'
        ], 200);
    }

    public function error404()
    {

        return response()->json([
            'success' => 'false',
            'error' => 'error auth'
        ], 200);
    }

}
