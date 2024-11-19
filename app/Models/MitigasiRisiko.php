<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitigasiRisiko extends Model
{
    use HasFactory;

    protected $table = 'mitigasi_risiko';

    protected $fillable = [
        'tanggal',
        'asset_id',
        'risk_id',
        'klausul',
        'mitigasi_risiko',
    ];

    public function asset() {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function risk() {
        return $this->belongsTo(Risk::class, 'risk_id');
    }
}

