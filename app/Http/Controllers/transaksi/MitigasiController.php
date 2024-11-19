<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\MitigasiRisiko;
use App\Models\Asset;
use App\Models\Risk;
use Illuminate\Http\Request;

class MitigasiController extends Controller
{
    public function show() {
        $mitigasiRisiko = MitigasiRisiko::all();
        $activePage = 'mitigasi'; 
        return view('transaksi.mitigasi_list', ['mitigasiRisiko' => $mitigasiRisiko, 'activePage' => $activePage]);
    }

    public function add() {
        $assets = Asset::all();
        $risks = Risk::all();
        $activePage = 'mitigasi'; // Set active page
        return view('transaksi.mitigasi_add', ['assets' => $assets, 'risks' => $risks, 'activePage' => $activePage]);
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'tanggal' => 'required|date',
        'risk_id' => 'required|integer',
        'klausul' => 'required|string',
        'mitigasi_risiko' => 'required|string',
    ]);

    // Buat data mitigasi baru
    $mitigasi = new MitigasiRisiko();
    $mitigasi->tanggal = $request->tanggal;
    $mitigasi->risk_id = $request->risk_id;
    $mitigasi->klausul = $request->klausul;
    $mitigasi->mitigasi_risiko = $request->mitigasi_risiko;

    // Tentukan asset_id, gunakan null jika nilai adalah 'none'
    $mitigasi->asset_id = $request->asset_id !== 'none' ? $request->asset_id : null;

    // Simpan data ke database
    $mitigasi->save();

    // Redirect ke halaman lain dengan pesan sukses
    return redirect()->route('mitigasi.show')->with('success', 'Data mitigasi berhasil disimpan!');
}


    public function edit($id) {
        $mitigasi = MitigasiRisiko::findOrFail($id);
        $assets = Asset::all();
        $risks = Risk::all();
        $activePage = 'mitigasi'; // Set active page
        return view('transaksi.mitigasi_edit', compact('mitigasi', 'assets', 'risks', 'activePage'));
    }

    public function update(Request $request, $id) {
        $mitigasi = MitigasiRisiko::findOrFail($id);
        $mitigasi->update($request->all());
        return redirect()->route('mitigasi.show')->with('success', 'Data mitigasi berhasil diperbarui!');
    }

    public function destroy($id) {
        $mitigasi = MitigasiRisiko::findOrFail($id);
        $mitigasi->delete();
        return redirect()->route('mitigasi.show')->with('success', 'Data mitigasi berhasil dihapus!');
    }
}
