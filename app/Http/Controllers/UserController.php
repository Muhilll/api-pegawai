<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validasi dan logika registrasi
        $validated = $request->validate([
            'nik' => 'required|unique:users,nik',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jkl' => 'required|string',
            'no_hp' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
        ]);
    
        // Proses registrasi dan simpan data
        $user = User::create([
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'jkl' => $validated['jkl'],
            'no_hp' => $validated['no_hp'],
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Registrasi berhasil',
            'data' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $user = User::where('username', $request->username)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
        }
    
        $token = $user->createToken('YourAppName')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'token' => $token,
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
            ]
        ]);
        
    } 
}
