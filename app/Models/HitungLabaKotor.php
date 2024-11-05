<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungLabaKotor extends Model
{
    protected $table = 'hitung_laba_kotor';
    protected $fillable = [
            'perkiraan_penjualan',
            'biaya_produksi',
            'laba_kotor',
            'user_id',
            'hpp'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
