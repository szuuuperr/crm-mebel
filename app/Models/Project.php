<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama', 'nomor_faktur', 'customer_id', 'order_id', 'jenis', 'deskripsi', 'prioritas',
        'anggaran', 'tanggal_mulai', 'target_selesai', 'tanggal_selesai',
        'progress', 'status', 'material_terpilih', 'kebutuhan_khusus',
        'rating', 'keluhan_masukan', 'jenis_kayu_id', 'finishing',
        'panjang', 'lebar', 'tinggi', 'berat'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'target_selesai' => 'date',
        'tanggal_selesai' => 'date',
        'anggaran' => 'decimal:2',
        'material_terpilih' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function milestones()
    {
        return $this->hasMany(ProjectMilestone::class)->orderBy('urutan');
    }

    public function members()
    {
        return $this->hasMany(ProjectMember::class);
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'perencanaan' => 'Perencanaan',
            'aktif' => 'Aktif',
            'ditunda' => 'Ditunda',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => $this->status,
        };
    }

    public function getStatusClassAttribute()
    {
        return match($this->status) {
            'perencanaan' => 'bg-surface-container text-outline',
            'aktif' => 'bg-primary/10 text-primary',
            'ditunda' => 'bg-amber-100 text-amber-800',
            'selesai' => 'bg-emerald-100 text-emerald-800',
            'dibatalkan' => 'bg-red-100 text-red-800',
            default => 'bg-surface-container text-outline',
        };
    }
}
