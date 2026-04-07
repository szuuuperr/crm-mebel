<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Notification extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['user_id', 'tipe', 'judul', 'pesan', 'icon', 'url', 'dibaca_pada'];

    protected $casts = [
        'dibaca_pada' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsUnreadAttribute()
    {
        return is_null($this->dibaca_pada);
    }

    public function getIconColorAttribute()
    {
        return match($this->tipe) {
            'pesanan' => 'bg-blue-100 text-blue-700',
            'pesan' => 'bg-primary/10 text-primary',
            'review' => 'bg-amber-100 text-amber-700',
            'stok' => 'bg-orange-100 text-orange-700',
            'pembayaran' => 'bg-emerald-100 text-emerald-700',
            'sistem' => 'bg-surface-container-high text-on-surface-variant',
            default => 'bg-surface-container-high text-on-surface-variant',
        };
    }
}
