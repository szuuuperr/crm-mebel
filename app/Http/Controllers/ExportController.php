<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $start = $request->input('date_start', '1970-01-01');
        $end = $request->input('date_end', date('Y-m-d'));

        $orders = Order::with('customer')->whereBetween('tanggal_pesanan', [$start, $end])->get();
        $projects = Project::with('customer')->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59'])->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=Export_Data_WebMebel_" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'ID', 'Tipe', 'Nomor Faktur', 'Customer', 'Status', 'Total / Anggaran', 'Tanggal', 'Rating', 'Masukan'
        ];

        $callback = function() use($orders, $projects, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    'Penjualan',
                    $order->nomor_faktur,
                    $order->customer?->nama ?? 'Umum',
                    $order->status,
                    $order->total,
                    $order->tanggal_pesanan,
                    $order->rating ?? '-',
                    $order->keluhan_masukan ?? '-'
                ]);
            }
            
            foreach ($projects as $proj) {
                fputcsv($file, [
                    $proj->id,
                    'Proyek',
                    $proj->nomor_faktur ?? '-',
                    $proj->customer?->nama ?? 'Umum',
                    $proj->status,
                    $proj->anggaran,
                    $proj->tanggal_mulai,
                    $proj->rating ?? '-',
                    $proj->keluhan_masukan ?? '-'
                ]);
            }
            
            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}

