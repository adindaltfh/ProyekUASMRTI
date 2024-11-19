<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cia extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_aset_id',
        'c',
        'i',
        'a',
        'aset_value'
    ];

    protected $table = 'cia';

    // Menghitung nilai aset_value secara otomatis
    public function calculateAsetValue()
    {
        return $this->c + $this->i + $this->a;
    }

    // Hook untuk menyimpan aset_value setiap kali model disimpan
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($cia) {
            $cia->aset_value = $cia->calculateAsetValue();
        });
    }
    
    // Fungsi untuk mendapatkan pilihan kategori aset dari enum
// Fungsi untuk mendapatkan pilihan kategori aset dari enum
public static function getKategoriAsetOptions()
{
    // Query untuk mengambil daftar nilai ENUM dari kolom 'kategori_aset_id' dalam tabel 'cia'
    $type = DB::select(DB::raw('SHOW COLUMNS FROM cia WHERE Field = "kategori_aset_id"'))[0]->Type;
    preg_match('/enum\((.*)\)$/', $type, $matches);
    $enumValues = [];

    foreach (explode(',', $matches[1]) as $value) {
        $enumValues[] = trim($value, "'");
    }

    return $enumValues;
}

}
