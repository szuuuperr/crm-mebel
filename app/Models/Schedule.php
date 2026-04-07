<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'judul', 'user_id', 'customer_id', 'project_id',
        'tipe', 'tanggal_mulai', 'tanggal_selesai', 'warna', 'catatan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getWarnaClassAttribute()
    {
        return match($this->tipe) {
            'deadline' => 'bg-primary',
            'pengiriman' => 'bg-emerald-400',
            'pertemuan' => 'bg-blue-400',
            'pengambilan' => 'bg-amber-400',
            'proposal' => 'bg-purple-400',
            'perawatan' => 'bg-orange-400',
            default => 'bg-surface-container-highest text-on-surface',
        };
    }
}
