<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pkl;

class APIPklController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pkl = Pkl::get();
        return response()->json($pkl, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'industri_id' => 'required|exists:industri,id',
            'guru_id' => 'required|exists:guru,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pkl = Pkl::create($validated);

        return response()->json($pkl, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pkl = Pkl::find($id);
        if (!$pkl) {
            return response()->json(['message' => 'PKL not found'], 404);
        }
        return response()->json($pkl, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pkl = Pkl::find($id);
        if (!$pkl) {
            return response()->json(['message' => 'PKL not found'], 404);
        }
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'industri_id' => 'required|exists:industri,id',
            'guru_id' => 'required|exists:guru,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $pkl->update($validated);

        return response()->json($pkl, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pkl::destroy($id);
        return response()->json(['message' => 'PKL deleted successfully'], 200);
    }
}
