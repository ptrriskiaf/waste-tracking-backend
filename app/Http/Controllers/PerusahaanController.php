<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::with('kendaraan')->get();
        return response()->json($perusahaan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_izin' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
        ]);

        $perusahaan = Perusahaan::create($validated);
        return response()->json($perusahaan, 201);
    }

    public function show(Perusahaan $perusahaan)
    {
        $perusahaan->load('kendaraan');
        return response()->json($perusahaan);
    }

    public function update(Request $request, Perusahaan $perusahaan)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_izin' => 'nullable|string|max:50',
            'kontak' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
        ]);

        $perusahaan->update($validated);
        return response()->json($perusahaan);
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();
        return response()->json(null, 204);
    }
}
