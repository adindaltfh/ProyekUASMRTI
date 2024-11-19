<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Risk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiskController extends Controller
{
    public function show(){
        $risk = Risk::all();
        $activePage = 'risk';
        
        return view('master.risk_list', ['activePage' => $activePage,'risk' => $risk]);
    }
    public function add()
{
    $activePage = 'risk';
    $kategoriAsetOptions = Risk::getKategoriAsetOptions(); // Get the enum options

    return view('master.risk_add', [
        'activePage' => $activePage,
        'kategoriAsetOptions' => $kategoriAsetOptions,
    ]);
}
    public function store(Request $request){
        try {

            $kategoriAsetOptions = implode(',', Risk::getKategoriAsetOptions());

            $request->validate([
                'nama_risiko' => 'required|string|max:255',
                'dampak' => 'required|string|max:255',
                'kategori_aset' => "required|in:$kategoriAsetOptions",
                'current_control' => 'required|string',
            ]);
    
            Risk::create([
                'nama_risiko' => $request->input('nama_risiko'),
                'dampak' => $request->input('dampak'),
                'kategori_aset' => $request->input('kategori_aset'),
                'current_control' => $request->input('current_control'),
            ]);
    
            return redirect()->route('risk.show')->with('success', 'Data risiko berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    public function edit($id)
    {
        $risk = Risk::findOrFail($id);
        $activePage = 'risk';
        $kategoriAsetOptions = Risk::getKategoriAsetOptions(); // Get the enum options
    
        return view('master.risk_edit', [
            'activePage' => $activePage,
            'risk' => $risk,
            'kategoriAsetOptions' => $kategoriAsetOptions,
        ]);
    }


    public function destroy($id)
{
    // Mulai transaksi untuk menghapus data secara atomik
    DB::transaction(function () use ($id) {
        $risk = Risk::find($id);

        if ($risk) {
            // Hapus semua data mitigasi yang terkait dengan risk_id ini
            $risk->mitigasiRisiko()->delete();

            // Hapus data risiko
            $risk->delete();
        }
    });

    // Redirect setelah transaksi selesai
    return redirect()->route('risk.show')->with('success', 'Data risiko berhasil dihapus!');
}

    


    public function update(Request $request, $id)
{
    try {
        $kategoriAsetOptions = implode(',', Risk::getKategoriAsetOptions());
        $request->validate([
            'nama_risiko' => 'required|string|max:255',
            'dampak' => 'required|string|max:255',
            'kategori_aset' => "required|in:$kategoriAsetOptions",
            'current_control' => 'required|string',
        ]);

        $risk = Risk::findOrFail($id);
        $risk->update([
            'nama_risiko' => $request->input('nama_risiko'),
            'dampak' => $request->input('dampak'),
            'kategori_aset' => $request->input('kategori_aset'),
            'current_control' => $request->input('current_control'),
        ]);

        return redirect()->route('risk.show')->with('success', 'Data risiko berhasil diperbarui!');
    } catch (\Exception $e) {
        return redirect()->route('risk.show')->with('error', $e->getMessage());
    }
}

}
