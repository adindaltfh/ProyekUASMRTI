<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assessment;
use App\Models\Cia;
use App\Models\MitigasiRisiko;
use App\Models\RiskValue;
use App\Models\Risk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\master\RiskValueController;

class DashboardController extends Controller
{

    public function index()
{
    // Data untuk kartu jumlah user
    $totalUsers = DB::table('users')->count();
    $adminCount = DB::table('users')->where('role', 'admin')->count();
    $userCount = DB::table('users')->where('role', 'user')->count();

    // Data untuk kartu jumlah asset
    $totalAssets = DB::table('assets')->count();
    $assetCategories = [
        'data' => DB::table('assets')->where('kategori', 'data')->count(),
        'software' => DB::table('assets')->where('kategori', 'software')->count(),
        'hardware' => DB::table('assets')->where('kategori', 'hardware')->count(),
        'network' => DB::table('assets')->where('kategori', 'network')->count(),
        'sumber_daya_manusia' => DB::table('assets')->where('kategori', 'sumber daya manusia')->count(),
    ];

    // Data untuk kartu jumlah risiko
    $totalRisks = DB::table('risk')->count();
    $riskCategories = [
        'data' => DB::table('risk')->where('kategori_aset', 'data')->count(),
        'software' => DB::table('risk')->where('kategori_aset', 'software')->count(),
        'hardware' => DB::table('risk')->where('kategori_aset', 'hardware')->count(),
        'network' => DB::table('risk')->where('kategori_aset', 'network')->count(),
        'sumber_daya_manusia' => DB::table('risk')->where('kategori_aset', 'sumber daya manusia')->count(),
    ];

    // Menambahkan variabel activePage untuk menunjukkan halaman aktif
    $activePage = 'dashboard';

    // Mengambil kategori level risiko dari RiskValueController
    $riskValueController = new RiskValueController();
    $riskLevelCategories = collect($riskValueController->getRiskLevelCategories());

    $ciaCategories = Cia::select('kategori_aset_id', 'c', 'i', 'a')->get();

    $years = Assessment::selectRaw('YEAR(tanggal_evaluasi) as year')
    ->distinct()->pluck('year')->sortDesc();

    return view('dashboard.dashboard', compact(
        'totalUsers', 'adminCount', 'userCount', 'years',
        'totalAssets', 'assetCategories',
        'totalRisks', 'riskCategories', 'activePage', 
        'riskLevelCategories', 'ciaCategories'
    ));
}

public function getChartData(Request $request)
{
    $year = $request->query('year', date('Y'));

    // Mengambil data mitigasi dan penilaian berdasarkan bulan
    $mitigationData = MitigasiRisiko::selectRaw('MONTH(tanggal) as month, COUNT(*) as count')
                    ->whereYear('tanggal', $year)
                    ->groupBy('month')
                    ->pluck('count', 'month')->toArray();

    $assessmentData = Assessment::selectRaw('MONTH(tanggal_evaluasi) as month, COUNT(*) as count')
                    ->whereYear('tanggal_evaluasi', $year)
                    ->groupBy('month')
                    ->pluck('count', 'month')->toArray();

    // Inisialisasi array 12 bulan dengan nilai 0
    $monthlyMitigation = array_fill(0, 12, 0);
    $monthlyAssessment = array_fill(0, 12, 0);

    // Isi data mitigasi pada array sesuai dengan bulan (index 0 untuk Jan, index 11 untuk Des)
    foreach ($mitigationData as $month => $count) {
        $monthlyMitigation[$month - 1] = $count;
    }
    
    // Isi data penilaian pada array sesuai dengan bulan (index 0 untuk Jan, index 11 untuk Des)
    foreach ($assessmentData as $month => $count) {
        $monthlyAssessment[$month - 1] = $count;
    }

    // Kirim array yang sudah sesuai urutan ke view
    return response()->json([
        'mitigationData' => $monthlyMitigation,
        'assessmentData' => $monthlyAssessment
    ]);
}

}

