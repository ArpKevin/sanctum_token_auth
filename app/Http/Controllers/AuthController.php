<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Csoki;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $user->tokens()->delete();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json(['token' => $token], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create($request->all());

        return response()->json(['message' => 'Registration successful!'], 201);
    }
    public function addCsoki(Request $request)
    {
        $request->validate([
            'csoki_id' => 'required|exists:csokik,id',
        ]);

        // $exists = DB::table('csoki_user')
        // ->where('csoki_id', $request->csoki_id)
        // ->where('user_id', $request->user()->id)
        // ->exists();

        // if ($exists) {
        //     return response()->json(['message' => 'You already have this Csoki associated with your account.'], 409);
        // }

        if ($request->user()->csokik()->where('csoki_id', $request->csoki_id)->exists()) {
            return response()->json(['message' => 'You already have this Csoki associated with your account.'], 409);
        }

        $csoki = Csoki::find($request->csoki_id);
        $request->user()->csokik()->attach($csoki);

        return response()->json(['message' => 'Csoki added successfully.']);
    }
    public function getUserCsokiIds(Request $request)
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        // Fetch the IDs of csokik associated with the user
        $csokiIds = $request->user()->csokik()->pluck('csokik.id');
    
        return response()->json([
            'csoki_ids' => $csokiIds
        ]);
    }
}
