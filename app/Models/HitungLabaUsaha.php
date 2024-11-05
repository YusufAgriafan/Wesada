<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungLabaUsaha extends Model
{
    protected $table = 'hitung_laba_usaha';
    protected $fillable = [
            'perkiraan_penjualan',
            'biaya_produksi',
            'laba_usaha',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
