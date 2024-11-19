<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temuan extends Model
{
    use HasFactory;

        protected $fillable = [
        'assessment_id',
        'dampak_id',

    ];
    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }
    protected $table = 'temuan';
}
