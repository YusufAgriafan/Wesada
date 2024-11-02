<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNavLink extends Model
{


    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'usaha_id'
    ];

    public function custom_nama_usaha()
    {
        return $this->belongsTo(CustomNamaUsaha::class);
    }
}
