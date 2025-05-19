<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru; // Pastikan Anda mengimpor model yang sesuai

class APIGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::get();
        return response() -> json($guru, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:20',
        'gender' => 'required|in:Laki-laki,Perempuan',
        'alamat' => 'required|string',
        'kontak' => 'required|string|max:15',
        'email' => 'required|email|unique:gurus,email',
    ]);

    $guru = Guru::create($validated);

    return response()->json($guru, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guru = Guru::find($id);
        return response()->json($guru, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    $guru = Guru::find($id);
    if (!$guru) {
        return response()->json(['message' => 'Guru not found'], 404);
    }
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:20',
        'gender' => 'required|in:Laki-laki,Perempuan',
        'alamat' => 'required|string',
        'kontak' => 'required|string|max:15',
        'email' => 'required|email|unique:gurus,email,'.$id,
    ]);

    $guru->update($validated);

        return response()->json($guru, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Guru::destroy($id);
        return response()->json([
            'message' => 'Deleted'
        ], 200);
    }
}
