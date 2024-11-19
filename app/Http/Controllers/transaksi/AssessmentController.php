<?php

namespace App\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\User;
use App\Models\Risk;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    // Tampilkan daftar assessment
    public function show()
    {
        $assessment = Assessment::with(['user', 'risk'])->get();
        $activePage = 'assessment';

        return view('transaksi.assessment_list', ['activePage' => $activePage, 'assessment' => $assessment]);
    }

    // Tampilkan form untuk menambahkan assessment baru
    public function add()
    {
        $activePage = 'assessment';
        $users = auth()->user()->role === 'admin' ? User::all() : []; // Semua pengguna hanya untuk admin
        $risks = Risk::all();
        $currentUser = auth()->user(); // Ambil data pengguna yang sedang login

        return view('transaksi.assessment_add', compact('activePage', 'users', 'risks', 'currentUser'));
    }


    // Simpan assessment baru ke dalam database
    public function store(Request $request)
{
    $currentUser = auth()->user();

    // Jika pengguna bukan admin, pastikan hanya menggunakan ID mereka
    if ($currentUser->role !== 'admin') {
        $request->merge(['user_id' => $currentUser->id]);
    }

    $request->validate([
        'user_id' => 'required|exists:users,id',
        'risk_id' => 'required|exists:risk,id',
        'tanggal_evaluasi' => 'required|date',
        'severity' => 'required|integer|min:1|max:10',
        'occurrence' => 'required|integer|min:1|max:10',
        'detection' => 'required|integer|min:1|max:10',
    ]);

    $severity = $request->input('severity');
    $occurrence = $request->input('occurrence');
    $detection = $request->input('detection');
    $rpn = Assessment::calculateRpn($severity, $occurrence, $detection);
    $level = Assessment::determineLevel($rpn);

    Assessment::create([
        'user_id' => $request->input('user_id'),
        'risk_id' => $request->input('risk_id'),
        'tanggal_evaluasi' => $request->input('tanggal_evaluasi'),
        'severity' => $severity,
        'occurrence' => $occurrence,
        'detection' => $detection,
        'rpn' => $rpn,
        'level' => $level,
    ]);

    return redirect()->route('assessment.show')->with('success', 'Data penilaian berhasil disimpan!');
}


    // Tampilkan form untuk mengedit assessment yang sudah ada
    public function edit($id)
{
    $activePage = 'assessment';
    $assessment = Assessment::findOrFail($id);
    $users = User::all(); // Semua pengguna
    $risks = Risk::all();
    $currentUser = auth()->user(); // Data pengguna yang login

    return view('transaksi.assessment_edit', compact('activePage', 'assessment', 'users', 'risks', 'currentUser'));
}


    // Perbarui data assessment yang sudah ada
    public function update(Request $request, $id)
{
    $currentUser = auth()->user();

    // Jika pengguna bukan admin, pastikan user_id sesuai dengan akun login
    if ($currentUser->role !== 'admin') {
        $request->merge(['user_id' => $currentUser->id]);
    }

    $request->validate([
        'user_id' => 'required|exists:users,id',
        'risk_id' => 'required|exists:risk,id',
        'tanggal_evaluasi' => 'required|date',
        'severity' => 'required|integer|min:1|max:10',
        'occurrence' => 'required|integer|min:1|max:10',
        'detection' => 'required|integer|min:1|max:10',
    ]);

    $severity = $request->input('severity');
    $occurrence = $request->input('occurrence');
    $detection = $request->input('detection');
    $rpn = Assessment::calculateRpn($severity, $occurrence, $detection);
    $level = Assessment::determineLevel($rpn);

    $assessment = Assessment::findOrFail($id);
    $assessment->update([
        'user_id' => $request->input('user_id'),
        'risk_id' => $request->input('risk_id'),
        'tanggal_evaluasi' => $request->input('tanggal_evaluasi'),
        'severity' => $severity,
        'occurrence' => $occurrence,
        'detection' => $detection,
        'rpn' => $rpn,
        'level' => $level,
    ]);

    return redirect()->route('assessment.show')->with('success', 'Data penilaian berhasil diperbarui!');
}

    // Hapus assessment
    public function destroy($id)
    {
        $assessment = Assessment::findOrFail($id);
        $assessment->delete();

        return redirect()->route('assessment.show')->with('success', 'Data penilaian berhasil dihapus!');
    }
}
