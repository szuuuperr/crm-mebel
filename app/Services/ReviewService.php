<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Project;

class ReviewService
{
    public function resolveReviewable(string $identifier): Order|Project|null
    {
        if (str_starts_with($identifier, 'INV-')) {
            return Order::with('customer', 'items.product')->where('nomor_faktur', $identifier)->first();
        }
        if (str_starts_with($identifier, 'PRJ-')) {
            return Project::with('customer')->where('nomor_faktur', $identifier)->first();
        }

        return null;
    }

    public function resolveType(Order|Project $reviewable): string
    {
        return $reviewable instanceof Order ? 'order' : 'project';
    }

    public function isReviewable(Order|Project $reviewable): bool
    {
        return $reviewable->status === 'selesai' && empty($reviewable->rating);
    }

    public function isAlreadyReviewed(Order|Project $reviewable): bool
    {
        return ! empty($reviewable->rating) || ! empty($reviewable->keluhan_masukan);
    }

    public function getShareUrl(Order|Project $reviewable): string
    {
        return route('review.show', $reviewable->nomor_faktur);
    }

    public function getShareMessage(Order|Project $reviewable): string
    {
        $customerName = $reviewable->customer->nama ?? 'Bapak/Ibu';
        $typeLabel = $this->resolveType($reviewable) === 'order' ? 'Pesanan' : 'Proyek';

        return "Halo {$customerName},\n\n"
            ."Terima kasih telah mempercayakan {$typeLabel} #{$reviewable->nomor_faktur} ke kami.\n"
            ."Kami sangat menghargai masukan Anda!\n\n"
            ."Beri penilaian Anda di:\n{$this->getShareUrl($reviewable)}\n\n"
            ."Salam,\nTim CRM Mebel";
    }

    public function getWhatsAppUrl(Order|Project $reviewable): string
    {
        $message = rawurlencode($this->getShareMessage($reviewable));
        $phone = $reviewable->customer->telepon ?? null;

        if ($phone) {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if (! str_starts_with($phone, '62')) {
                $phone = '62'.ltrim($phone, '0');
            }

            return "https://wa.me/{$phone}?text={$message}";
        }

        return "https://wa.me/?text={$message}";
    }

    public function getEmailUrl(Order|Project $reviewable): string
    {
        $customerEmail = $reviewable->customer->email ?? '';
        $typeLabel = $this->resolveType($reviewable) === 'order' ? 'Pesanan' : 'Proyek';
        $subject = rawurlencode("Mohon Penilaian {$typeLabel} #{$reviewable->nomor_faktur}");
        $body = rawurlencode($this->getShareMessage($reviewable));

        $to = $customerEmail ? rawurlencode($customerEmail) : '';

        return "mailto:{$to}?subject={$subject}&body={$body}";
    }
}
