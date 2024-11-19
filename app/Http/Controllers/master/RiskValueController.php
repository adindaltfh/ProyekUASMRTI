<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\RiskValue;
use App\Models\Risk;
use Illuminate\Http\Request;

class RiskValueController extends Controller
{
    public function show()
    {
        $riskvalues = RiskValue::with('risk')->get();
        $activePage = 'riskvalue';

        // Ambil data kategori tingkat risiko
        $riskLevelCategories = $this->getRiskLevelCategories();

        return view('master.riskvalue_list', [
            'activePage' => $activePage,
            'riskvalues' => $riskvalues,
            'riskLevelCategories' => $riskLevelCategories
        ]);
    }

    public function add()
    {
        $activePage = 'riskvalue';
        $risk = Risk::all();

        return view('master.riskvalue_add', [
            'activePage' => $activePage,
            'risk' => $risk,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'risk_id' => 'required|exists:risk,id',
                'nilai_risiko' => 'required|integer|between:1,10',
                'level' => 'required|in:low,medium,high,critical',
            ]);

            RiskValue::create([
                'risk_id' => $request->input('risk_id'),
                'nilai_risiko' => $request->input('nilai_risiko'),
                'level' => $request->input('level'),
            ]);

            return redirect()->route('riskvalue.show')->with('success', 'Data nilai risiko berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getRiskLevelCategories()
    {
        // Menghitung jumlah setiap kategori level risiko dan mengembalikan dalam format array
        return [
            ['level' => 'low', 'count' => RiskValue::where('level', 'low')->count()],
            ['level' => 'medium', 'count' => RiskValue::where('level', 'medium')->count()],
            ['level' => 'high', 'count' => RiskValue::where('level', 'high')->count()],
        ];
    }
    
    public function edit($id)
    {
        $riskvalue = RiskValue::find($id);
        $activePage = 'riskvalue';
        $risk = Risk::all();

        if (!$riskvalue) {
            abort(404);
        }

        return view('master.riskvalue_edit', [
            'activePage' => $activePage,
            'riskvalue' => $riskvalue,
            'risk' => $risk
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'risk_id' => 'required|exists:risk,id',
                'nilai_risiko' => 'required|integer|between:1,10',
                'level' => 'required|in:low,medium,high,critical',
            ]);

            $riskvalue = RiskValue::find($id);

            if ($riskvalue) {
                $riskvalue->update([
                    'risk_id' => $request->input('risk_id'),
                    'nilai_risiko' => $request->input('nilai_risiko'),
                    'level' => $request->input('level'),
                ]);

                return redirect()->route('riskvalue.show')->with('success', 'Data nilai risiko berhasil diperbarui!');
            } else {
                return redirect()->route('riskvalue.show')->with('error', 'Data nilai risiko tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('riskvalue.show')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $riskvalue = RiskValue::find($id);

        if ($riskvalue) {
            $riskvalue->delete();
            return redirect()->route('riskvalue.show')->with('success', 'Data nilai risiko berhasil dihapus!');
        } else {
            return redirect()->route('riskvalue.show')->with('error', 'Data nilai risiko tidak ditemukan.');
        }
    }
}