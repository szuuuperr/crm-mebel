<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_produk', 'kategori_id', 'jenis_kayu_id', 'harga', 'deskripsi', 'berat',
        'sku', 'stok', 'finishing', 'panjang', 'lebar', 'tinggi', 'koleksi',
        'visibilitas', 'is_unggulan', 'terima_kustom', 'status',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'berat' => 'decimal:2',
        'is_unggulan' => 'boolean',
        'terima_kustom' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function jenisKayu()
    {
        return $this->belongsTo(WoodType::class, 'jenis_kayu_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function coverImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_cover', true);
    }

    public function getCoverUrlAttribute()
    {
        $cover = $this->coverImage ?? $this->images->first();
        return $cover ? $cover->path : null;
    }

    public function getHargaFormatAttribute()
    {
        return 'Rp ' . number_format((float) $this->harga, 0, ',', '.');
    }
}
