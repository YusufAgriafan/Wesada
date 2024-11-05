<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungHargaJual extends Model
{
    protected $table = 'hitung_harga_jual';
    protected $fillable = [
            'total_biaya_variabel',
            'jumlah_produk',
            'biaya_variabel_unit',
            'presentase',
            'harga_jual',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
