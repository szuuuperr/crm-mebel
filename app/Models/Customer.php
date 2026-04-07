<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama', 'email', 'telepon', 'perusahaan', 'jabatan',
        'alamat', 'kota', 'provinsi', 'kode_pos',
        'status_loyalitas', 'avatar', 'catatan',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'customer_id');
    }

    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->nama);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials;
    }
}
