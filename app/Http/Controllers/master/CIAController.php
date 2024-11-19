<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Cia;
use Illuminate\Http\Request;

class CIAController extends Controller
{
    public function show()
    {
        $cia = Cia::all();
        $activePage = 'cia';

        return view('master.cia_list', ['activePage' => $activePage, 'cia' => $cia]);
    }

    public function add()
    {
        $activePage = 'cia';
        $kategoriAsetOptions = Cia::getKategoriAsetOptions(); // Ambil daftar kategori dari ENUM
        
        // Dapatkan kategori yang sudah digunakan di tabel `cia`
        $usedKategoriAset = Cia::pluck('kategori_aset_id')->toArray();

        return view('master.cia_add', compact('activePage', 'kategoriAsetOptions', 'usedKategoriAset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_aset_id' => 'required|in:' . implode(',', Cia::getKategoriAsetOptions()) . '|unique:cia,kategori_aset_id', // Validasi ENUM dan unik
            'c' => 'required|integer|min:1|max:9',
            'i' => 'required|integer|min:1|max:9',
            'a' => 'required|integer|min:1|max:9',
        ]);

        $aset_value = $request->c + $request->i + $request->a;

        Cia::create([
            'kategori_aset_id' => $request->kategori_aset_id, // Gunakan kategori_aset_id langsung
            'c' => $request->c,
            'i' => $request->i,
            'a' => $request->a,
            'aset_value' => $aset_value
        ]);

        return redirect()->route('cia.show')->with('success', 'Data analisis CIA berhasil disimpan!');
    }

    public function edit($id)
    {
        $activePage = 'cia';
        $cia = Cia::findOrFail($id);
        $kategoriAsetOptions = Cia::getKategoriAsetOptions();

        // Dapatkan kategori yang sudah digunakan di tabel `cia`, kecuali yang sedang diedit
        $usedKategoriAset = Cia::where('id', '!=', $id)->pluck('kategori_aset_id')->toArray();

        return view('master.cia_edit', compact('activePage', 'cia', 'kategoriAsetOptions', 'usedKategoriAset'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'kategori_aset_id' => 'required|in:' . implode(',', Cia::getKategoriAsetOptions()) . '|unique:cia,kategori_aset_id,' . $id, // Validasi ENUM dan unik kecuali untuk ID saat ini
                'c' => 'required|integer|min:1|max:9',
                'i' => 'required|integer|min:1|max:9',
                'a' => 'required|integer|min:1|max:9',
            ]);

            $aset_value = $request->c + $request->i + $request->a;

            $cia = Cia::findOrFail($id);
            $cia->update([
                'kategori_aset_id' => $request->kategori_aset_id, // Gunakan kategori_aset_id langsung
                'c' => $request->c,
                'i' => $request->i,
                'a' => $request->a,
                'aset_value' => $aset_value
            ]);

            return redirect()->route('cia.show')->with('success', 'Data analisis CIA berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('cia.show')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $cia = Cia::findOrFail($id);
        $cia->delete();
        return redirect()->route('cia.show')->with('success', 'Data analisis CIA berhasil dihapus!');
    }
}