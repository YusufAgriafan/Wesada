<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungHpp extends Model
{
    protected $table = 'hitung_hpp';
    protected $fillable = [
            'persediaan_awal',
            'persediaan_akhir',
            'total_biaya_variabel',
            'hpp',
            'jumlah_produk',
            'hpp_unit',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
