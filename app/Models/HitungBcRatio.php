<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungBcRatio extends Model
{
    protected $table = 'hitung_bc_ratio';
    protected $fillable = [
            'perkiraan_penjualan',
            'biaya_produksi',
            'bc_ratio',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
