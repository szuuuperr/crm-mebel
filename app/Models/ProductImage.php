<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'path', 'alt_text', 'urutan', 'is_cover'];

    protected $casts = ['is_cover' => 'boolean'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
