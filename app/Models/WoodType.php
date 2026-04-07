<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WoodType extends Model
{
    protected $table = 'wood_types';

    protected $fillable = ['nama', 'kode_warna', 'deskripsi', 'negara_asal'];

    public function products()
    {
        return $this->hasMany(Product::class, 'jenis_kayu_id');
    }
}
