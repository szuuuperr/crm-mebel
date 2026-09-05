<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nomor_faktur', 'customer_id', 'user_id', 'tanggal_pesanan',
        'subtotal', 'pajak_persen', 'pajak', 'ongkir', 'diskon', 'total',
        'status', 'prioritas', 'metode_pembayaran', 'status_pembayaran',
        'estimasi_pengiriman', 'alamat_pengiriman', 'catatan',
        'rating', 'keluhan_masukan',
    ];

    protected $casts = [
        'tanggal_pesanan' => 'date',
        'estimasi_pengiriman' => 'date',
        'total' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    public function getTotalFormatAttribute()
    {
        return 'Rp '.number_format($this->total, 0, ',', '.');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'prospek' => 'Prospek Baru',
            'dalam_produksi' => 'Dalam Produksi',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => $this->status,
        };
    }

    public function getStatusClassAttribute()
    {
        return match ($this->status) {
            'prospek' => 'bg-stone-100 text-stone-800',
            'dalam_produksi' => 'bg-amber-100 text-amber-800',
            'dikirim' => 'bg-blue-100 text-blue-800',
            'selesai' => 'bg-emerald-100 text-emerald-800',
            'dibatalkan' => 'bg-red-100 text-red-800',
            default => 'bg-stone-100 text-stone-800',
        };
    }

    public function getReviewUrlAttribute()
    {
        return route('review.show', $this->nomor_faktur);
    }

    public function getReviewShareMessageAttribute()
    {
        $customerName = $this->customer->nama ?? 'Bapak/Ibu';

        return "Halo {$customerName},\n\n"
            ."Terima kasih telah mempercayakan Pesanan #{$this->nomor_faktur} ke kami.\n"
            ."Kami sangat menghargai masukan Anda!\n\n"
            ."Beri penilaian Anda di:\n{$this->review_url}\n\n"
            ."Salam,\nTim CRM Mebel";
    }

    public function getReviewWhatsappUrlAttribute()
    {
        $message = rawurlencode($this->review_share_message);
        $phone = $this->customer->telepon ?? null;

        if ($phone) {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if (! str_starts_with($phone, '62')) {
                $phone = '62'.ltrim($phone, '0');
            }

            return "https://wa.me/{$phone}?text={$message}";
        }

        return "https://wa.me/?text={$message}";
    }

    public function getReviewEmailUrlAttribute()
    {
        $customerEmail = $this->customer->email ?? '';
        $subject = rawurlencode("Mohon Penilaian Pesanan #{$this->nomor_faktur}");
        $body = rawurlencode($this->review_share_message);

        $to = $customerEmail ? rawurlencode($customerEmail) : '';

        return "mailto:{$to}?subject={$subject}&body={$body}";
    }
}
