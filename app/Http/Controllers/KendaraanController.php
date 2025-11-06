<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'perusahaan_id' => 'required|exists:perusahaan,id',
            'no_polisi' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'merk' => 'nullable|string|max:255',
            'kapasitas' => 'nullable|numeric',
            'aktif' => 'sometimes|boolean',
        ]);
    
        $kendaraan = Kendaraan::create($validated);
        return response()->json($kendaraan, 201);
    }
    
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'perusahaan_id' => 'sometimes|exists:perusahaan,id',
            'no_polisi' => 'sometimes|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'merk' => 'nullable|string|max:255',
            'kapasitas' => 'nullable|numeric',
            'aktif' => 'sometimes|boolean',
        ]);
    
        $kendaraan->update($validated);
        return response()->json($kendaraan);
    }
    
}
