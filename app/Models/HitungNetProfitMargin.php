<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungNetProfitMargin extends Model
{
    protected $table = 'hitung_net_profit_margin';
    protected $fillable = [
            'laba_usaha',
            'perkiraan_penjualan',
            'net_profit_margin',
            'user_id'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
