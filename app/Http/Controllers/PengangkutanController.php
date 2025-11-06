<?php

namespace App\Http\Controllers;

use App\Models\Pengangkutan;
use Illuminate\Http\Request;

class PengangkutanController extends Controller
{
    public function index()
    {
        $pengangkutan = Pengangkutan::with(['perusahaan','kendaraan'])->get();
        return response()->json($pengangkutan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'perusahaan_id' => 'required|exists:perusahaan,id',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal' => 'required|date',
            'jenis_limbah' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'status' => 'nullable|in:proses,selesai',
        ]);

        $pengangkutan = Pengangkutan::create($validated);
        return response()->json($pengangkutan, 201);
    }

    public function show(Pengangkutan $pengangkutan)
    {
        $pengangkutan->load(['perusahaan','kendaraan']);
        return response()->json($pengangkutan);
    }

    public function update(Request $request, Pengangkutan $pengangkutan)
    {
        $validated = $request->validate([
            'perusahaan_id' => 'sometimes|exists:perusahaan,id',
            'kendaraan_id' => 'sometimes|exists:kendaraan,id',
            'tanggal' => 'sometimes|date',
            'jenis_limbah' => 'sometimes|string|max:255',
            'tujuan' => 'sometimes|string|max:255',
            'status' => 'nullable|in:proses,selesai',
        ]);

        $pengangkutan->update($validated);
        return response()->json($pengangkutan);
    }

    public function destroy(Pengangkutan $pengangkutan)
    {
        $pengangkutan->delete();
        return response()->json(null, 204);
    }
}
