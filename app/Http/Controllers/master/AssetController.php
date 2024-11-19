<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Asset; // Ubah ke Asset
use App\Models\Risk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    public function show()
    {
        // Eager load the risks relationship
        $assets = Asset::with('risk')->get(); // Updated line
        $activePage = 'asset'; // Ubah ke asset

        return view('master.asset_list', ['assets' => $assets, 'activePage' => $activePage]); // Ubah ke asset_list
    }
    
    public function add()
    {
        $options2 = Risk::all(); // Ubah ke Risk
        $activePage = 'asset'; // Ubah ke asset
        return view('master.asset_add', ['options2' => $options2, 'activePage' => $activePage]); // Ubah ke asset_add
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_aset' => 'required|string|max:255',
                'kategori' => 'required|string|max:255',
                'risiko_terkait' => 'required|integer',
            ]);

            Asset::create([ // Ubah ke Asset
                'nama_aset' => $request->input('nama_aset'), // Ubah ke nama_aset
                'kategori' => $request->input('kategori'), 
                'risiko_terkait' => $request->input('risiko_terkait'),
            ]);

            return redirect()->route('asset.show')->with('success', 'Data aset berhasil disimpan!'); // Ubah ke asset.show
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $asset = Asset::find($id); // Ubah ke Asset
        $options2 = Risk::all(); // Ubah ke Risk
        $selectedRisk = $asset->risiko_terkait;
        $activePage = 'asset'; // Ubah ke asset
        if (!$asset) {
            abort(404);
        }
        return view('master.asset_edit', ['asset' => $asset, 'activePage' => $activePage, 'options2' => $options2, 'selectedRisk' => $selectedRisk]); // Ubah ke asset_edit
    }

    public function destroy($id)
{
    // Gunakan variabel untuk menyimpan hasil setelah transaksi selesai
    $redirect = redirect()->route('asset.show');

    DB::transaction(function() use ($id, &$redirect) {
        // Set semua asset_id terkait di tabel mitigasi menjadi null
        DB::table('mitigasi_risiko')->where('asset_id', $id)->update(['asset_id' => null]);

        // Temukan aset berdasarkan id
        $asset = Asset::find($id);
        if ($asset) {
            $asset->delete();
            // Set pesan keberhasilan
            $redirect = redirect()->route('asset.show')->with('success', 'Data aset berhasil dihapus!');
        } else {
            // Set pesan error jika data tidak ditemukan
            $redirect = redirect()->route('asset.show')->with('error', 'Data aset tidak ditemukan.');
        }
    });

    // Redirect setelah transaksi selesai
    return $redirect;
}



    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_aset' => 'required|string|max:255',
                'kategori' => 'required|string|max:255',
                'risiko_terkait' => 'required|integer',
            ]);

            $asset = Asset::find($id); // Ubah ke Asset
            if ($asset) {
                $asset->update([ // Ubah ke Asset
                    'nama_aset' => $request->input('nama_aset'), // Ubah ke nama_aset
                    'kategori' => $request->input('kategori'), 
                    'risiko_terkait' => $request->input('risiko_terkait'),
                ]);

                return redirect()->route('asset.show')->with('success', 'Data aset berhasil diperbarui!'); // Ubah ke asset.show
            } else {
                return redirect()->route('asset.show')->with('error', 'Data aset tidak ditemukan.'); // Ubah ke asset.show
            }
        } catch (\Exception $e) {
            return redirect()->route('asset.show')->with('error', $e->getMessage()); // Ubah ke asset.show
        }
    }
}