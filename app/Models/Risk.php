<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Risk extends Model
{
    use HasFactory;

    protected $table = 'risk';

    protected $fillable = [
        'nama_risiko',
        'dampak',
        'kategori_aset',
        'current_control',
    ];

    // Helper function to get enum values
    public static function getKategoriAsetOptions()
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM risk WHERE Field = 'kategori_aset'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = [];
        foreach (explode(',', $matches[1]) as $value) {
            $enum[] = trim($value, "'");
        }
        return $enum;
    }

    public static function boot()
{
    parent::boot();

    // Add a deleting event listener to clear related assets
    static::deleting(function ($risk) {
        foreach ($risk->assets as $asset) {
            $asset->update(['risiko_terkait' => null]);
        }
    });
}


    // Define the relationship to Asset
    public function assets()
    {
        return $this->hasMany(Asset::class, 'risiko_terkait', 'id');
    }

        public function mitigasiRisiko()
    {
        return $this->hasMany(MitigasiRisiko::class, 'risk_id', 'id');
    }

}
