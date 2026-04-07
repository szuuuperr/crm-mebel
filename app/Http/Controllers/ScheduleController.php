<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;

        $schedules = Schedule::with(['customer', 'project'])
            ->whereYear('tanggal_mulai', $year)
            ->whereMonth('tanggal_mulai', $month)
            ->orderBy('tanggal_mulai')
            ->get();

        // Group events by day of month
        $events = [];
        foreach ($schedules as $s) {
            $day = $s->tanggal_mulai->day;
            $events[$day][] = [
                'title' => $s->judul,
                'color' => $s->warna ?? $s->warna_class,
            ];
        }

        // Upcoming events (next 30 days)
        $upcoming = Schedule::with(['customer', 'project'])
            ->where('tanggal_mulai', '>=', now())
            ->orderBy('tanggal_mulai')
            ->take(4)
            ->get();

        // Stats
        $monthlyStats = [
            'total' => $schedules->count(),
            'pengiriman' => $schedules->where('tipe', 'pengiriman')->count(),
            'pertemuan' => $schedules->where('tipe', 'pertemuan')->count(),
            'deadline' => $schedules->where('tipe', 'deadline')->count(),
            'lainnya' => $schedules->whereNotIn('tipe', ['pengiriman', 'pertemuan', 'deadline'])->count(),
        ];

        // Calendar meta
        $firstDayOfMonth = Carbon::create($year, $month, 1);
        $startDay = $firstDayOfMonth->dayOfWeek; // 0=Sun
        $daysInMonth = $firstDayOfMonth->daysInMonth;
        $prevMonth = $firstDayOfMonth->copy()->subMonth();
        $daysInPrevMonth = $prevMonth->daysInMonth;

        return view('pages.schedule', [
            'activePage' => 'dashboard',
            'events' => $events,
            'upcoming' => $upcoming,
            'monthlyStats' => $monthlyStats,
            'monthLabel' => $firstDayOfMonth->translatedFormat('F Y'),
            'startDay' => $startDay,
            'daysInMonth' => $daysInMonth,
            'daysInPrevMonth' => $daysInPrevMonth,
            'today' => $now->day,
            'isCurrentMonth' => $now->month == $month && $now->year == $year,
        ]);
    }
}
