<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungBiayaTetap extends Model
{
    protected $table = 'hitung_biaya_tetap';
    protected $fillable = [
            'item',
            'kuantitas',
            'harga_satuan',
            'total_biaya',
            'keterangan',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
