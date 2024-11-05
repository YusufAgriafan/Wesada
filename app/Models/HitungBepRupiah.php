<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungBepRupiah extends Model
{
    protected $table = 'hitung_bep_rupiah';
    protected $fillable = [
            'total_biaya_tetap',
            'harga_jual',
            'biaya_variabel_unit',
            'bep_rupiah',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
