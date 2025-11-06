<?php

namespace App\Http\Controllers;

use App\Models\LokasiKendaraan;
use Illuminate\Http\Request;

class Lokasi_kendaraanController extends Controller
{
    public function index()
    {
        return response()->json(LokasiKendaraan::with('kendaraan')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'speed' => 'nullable|numeric',
            'recorded_at' => 'required|date_format:Y-m-d H:i:s',
        ]);
    
        $lokasi = LokasiKendaraan::create($validated);
        return response()->json($lokasi, 201);
    }
    
    public function update(Request $request, LokasiKendaraan $lokasi_kendaraan)
    {
        $validated = $request->validate([
            'lat' => 'sometimes|numeric',
            'lng' => 'sometimes|numeric',
            'speed' => 'nullable|numeric',
            'recorded_at' => 'sometimes|date_format:Y-m-d H:i:s',
        ]);
    
        $lokasi_kendaraan->update($validated);
        return response()->json($lokasi_kendaraan);
    }
    

    public function show(LokasiKendaraan $lokasi_kendaraan)
    {
        $lokasi_kendaraan->load('kendaraan');
        return response()->json($lokasi_kendaraan);
    }

   
    public function destroy(LokasiKendaraan $lokasi_kendaraan)
    {
        $lokasi_kendaraan->delete();
        return response()->json(null, 204);
    }
}
