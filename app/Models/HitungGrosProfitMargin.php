<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungGrosProfitMargin extends Model
{
    protected $table = 'hitung_gros_profit_margin';
    protected $fillable = [
            'laba_kotor',
            'perkiraan_penjualan',
            'gros_profit_margin',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
