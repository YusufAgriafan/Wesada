<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungBep extends Model
{
    protected $table = 'hitung_bep';
    protected $fillable = [
            'total_biaya_tetap',
            'harga_jual',
            'biaya_variabel_unit',
            'bep',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
