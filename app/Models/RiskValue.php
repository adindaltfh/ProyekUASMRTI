<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nilai_risiko',
        'risk_id', // Tambahkan kolom risk_id
        'level' // Tambahkan kolom level
    ];
    

    protected $table = 'risk_value';

    public function risk()
    {
        return $this->belongsTo(Risk::class, 'risk_id');
    }
}