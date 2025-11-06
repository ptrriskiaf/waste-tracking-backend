<?php

namespace App\Http\Controllers;

use App\Models\JasaPengangkutan;
use Illuminate\Http\Request;

class Jasa_PengangkutanController extends Controller
{
    public function index()
    {
        return response()->json(JasaPengangkutan::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jasa' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $jasa = JasaPengangkutan::create($validated);
        return response()->json($jasa, 201);
    }

    public function show(JasaPengangkutan $jasa_pengangkutan)
    {
        return response()->json($jasa_pengangkutan);
    }

    public function update(Request $request, JasaPengangkutan $jasa_pengangkutan)
    {
        $validated = $request->validate([
            'nama_jasa' => 'sometimes|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $jasa_pengangkutan->update($validated);
        return response()->json($jasa_pengangkutan);
    }

    public function destroy(JasaPengangkutan $jasa_pengangkutan)
    {
        $jasa_pengangkutan->delete();
        return response()->json(null, 204);
    }
}
