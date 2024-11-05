<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungPerkiraanPenjualan extends Model
{
    protected $table = 'hitung_perkiraan_penjualan';
    protected $fillable = [
            'harga_jual',
            'jumlah_produk',
            'perkiraan_penjualan',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
