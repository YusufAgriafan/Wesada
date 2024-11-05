<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungBiayaProduksi extends Model
{
    protected $table = 'hitung_biaya_produksi';
    protected $fillable = [
            'persediaan_awal',
            'persediaan_akhir',
            'total_biaya_variabel',
            'biaya_produksi',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
