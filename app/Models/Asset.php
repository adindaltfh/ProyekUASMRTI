<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'nama_aset',
        'risiko_terkait',
    ];

    public function risk()
    {
        // Specify 'risiko_terkait' as the foreign key to match the column name in the database
        return $this->belongsTo(Risk::class, 'risiko_terkait', 'id');
    }

    public function mitigasiRisiko()
    {
        return $this->hasMany(MitigasiRisiko::class, 'asset_id', 'id');
    }


    protected $table = 'assets';
}
