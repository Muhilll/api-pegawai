<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamaran; // Sesuaikan dengan model yang kamu gunakan

class LamaranController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048', // Validasi file CV
            'user_id' => 'required|integer',
            'lowongan_id' => 'required|integer',
            'nama' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string',
            'pendidikan' => 'required|string',
        ]);

        // Logika untuk menyimpan lamaran
        $cvPath = $request->file('cv')->store('cv', 'public'); // Menyimpan file CV

        // Simpan data lamaran
        Lamaran::create([
            'user_id' => $request->user_id,
            'lowongan_id' => $request->lowongan_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'pendidikan' => $request->pendidikan,
            'cv_path' => $cvPath,
        ]);

        return response()->json(['message' => 'Lamaran berhasil dikirim']);
    }
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
    
        $lamaran = Lamaran::with('lowongan')
        ->where('user_id', $userId)
        ->get();
    
    
        return response()->json([
            'success' => true,
            'data' => $lamaran
        ]);
    }

    public function getLamaranByUser(Request $request)
    {
        $userId = $request->query('user_id');
        $lamaran = Lamaran::where('user_id', $userId)->get();
    
        return response()->json([
            'success' => true,
            'data' => $lamaran
        ]);
    }
    
    public function getByUser($user_id)
{
    $data = Lamaran::with('lowongan')->where('user_id', $user_id)->get();
    return response()->json([
        'success' => true,
        'data' => $data
    ]);
}

    

    

}
