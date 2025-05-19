<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industri; // Pastikan Anda mengimpor model yang sesuai

class APIIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industri = Industri::get();
        return response()->json($industri, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:15',
            'email' => 'required|email|unique:industri,email',
            'website' => 'nullable|url',
        ]);

        $industri = Industri::create($validated);

        return response()->json($industri, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $industri = Industri::find($id);
        if (!$industri) {
            return response()->json(['message' => 'Industri not found'], 404);
        }
        return response()->json($industri, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $industri = Industri::find($id);
        if (!$industri) {
            return response()->json(['message' => 'Industri not found'], 404);
        }
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:15',
            'email' => 'required|email|unique:industri,email,' . $id,
            'website' => 'nullable|url',
        ]);

        $industri->update($validated);

        return response()->json($industri, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Industri::destroy($id);
        return response()->json(['message' => 'Industri deleted successfully'], 200);
    }
}
