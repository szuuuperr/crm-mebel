<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', 1) // TODO: auth user
            ->orderByDesc('created_at')
            ->get();

        $today = $notifications->filter(fn($n) => $n->created_at->isToday());
        $yesterday = $notifications->filter(fn($n) => $n->created_at->isYesterday());
        $earlier = $notifications->filter(fn($n) => !$n->created_at->isToday() && !$n->created_at->isYesterday());

        $unreadCount = $notifications->whereNull('dibaca_pada')->count();
        $orderCount = $notifications->where('tipe', 'pesanan')->count();
        $messageCount = $notifications->where('tipe', 'pesan')->count();
        $systemCount = $notifications->where('tipe', 'sistem')->count();

        return view('pages.notifications', [
            'activePage' => 'dashboard',
            'today' => $today,
            'yesterday' => $yesterday,
            'earlier' => $earlier,
            'unreadCount' => $unreadCount,
            'orderCount' => $orderCount,
            'messageCount' => $messageCount,
            'systemCount' => $systemCount,
        ]);
    }
}
