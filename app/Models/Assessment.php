<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'risk_id', 'tanggal_evaluasi', 'severity', 'occurrence', 'detection', 'rpn', 'level'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function risk()
    {
        return $this->belongsTo(Risk::class);
    }

    public static function calculateRpn($severity, $occurrence, $detection)
    {
        return $severity * $occurrence * $detection;
    }

    public static function determineLevel($rpn)
    {
        if ($rpn >= 0 && $rpn <= 19) return 'Very Low';
        if ($rpn >= 20 && $rpn <= 79) return 'Low';
        if ($rpn >= 80 && $rpn <= 119) return 'Medium';
        if ($rpn >= 120 && $rpn <= 199) return 'High';
        return 'Very High';
    }
}
