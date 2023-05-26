<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ParkirController extends Controller
{
    public function index()
    {
        $parkirs = Parkir::all();
        return view('parkir.index', compact('parkirs'));
    }

    public function create()
    {
        return view('parkir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required'
        ]);

        $jenisKendaraan = $request->jenis_kendaraan;
        $jamMasuk = Carbon::parse($request->jam_masuk);
        $jamKeluar = Carbon::parse($request->jam_keluar);
        $durasi = $jamMasuk->diffInHours($jamKeluar);
        $totalBiaya = $this->hitungBiayaParkir($jenisKendaraan, $durasi);

        Parkir::create([
            'jenis_kendaraan' => $jenisKendaraan,
            'jam_masuk' => $jamMasuk,
            'jam_keluar' => $jamKeluar,
            'total_biaya' => $totalBiaya
        ]);

        return redirect()->route('parkir.index')->with('success', 'Data parkir berhasil ditambahkan.');
    }

    public function edit(Parkir $parkir)
    {
        return view('parkir.edit', compact('parkir'));
    }

    public function update(Request $request, Parkir $parkir)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required'
        ]);

        $jenisKendaraan = $request->jenis_kendaraan;
        $jamMasuk = Carbon::parse($request->jam_masuk);
        $jamKeluar = Carbon::parse($request->jam_keluar);
        $durasi = $jamMasuk->diffInHours($jamKeluar);
        $totalBiaya = $this->hitungBiayaParkir($jenisKendaraan, $durasi);

        $parkir->update([
            'jenis_kendaraan' => $jenisKendaraan,
            'jam_masuk' => $jamMasuk,
            'jam_keluar' => $jamKeluar,
            'total_biaya' => $totalBiaya
        ]);

        return redirect()->route('parkir.index')->with('success', 'Data parkir berhasil diperbarui.');
    }

    public function destroy(Parkir $parkir)
    {
        $parkir->delete();
        return redirect()->route('parkir.index')->with('success', 'Data parkir berhasil dihapus.');
    }

    private function hitungBiayaParkir($jenisKendaraan, $durasi)
{
    $biayaPerJam = ($jenisKendaraan === 'motor') ? 2000 : 5000;
    $biayaPertama = ($jenisKendaraan === 'motor') ? 1000 : 3000;

    $totalBiaya = $biayaPertama;
    $durasi -= 2;

    while ($durasi > 0) {
        if ($durasi >= 3) {
            $totalBiaya += 2000; // Perjam tetap 2000 untuk motor setelah 3 jam pertama
        } else {
            $totalBiaya += $biayaPerJam;
        }
        $durasi--;
    }

    if ($totalBiaya > 10000) {
        $diskon = ($jenisKendaraan === 'motor') ? 0.05 : 0.1;
        $totalBiaya -= $totalBiaya * $diskon;
    }

    return $totalBiaya;
}





}
