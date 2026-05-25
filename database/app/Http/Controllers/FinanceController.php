<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | DATA TRANSAKSI + TIKET
        |--------------------------------------------------------------------------
        */

        $transaksis = DB::table('transaksis')
            ->join('tikets', 'transaksis.id_tiket', '=', 'tikets.id')

            ->select(
                'transaksis.status',
                'transaksis.sub_total',
                'transaksis.tanggal',

                'tikets.nama_tiket',
                'tikets.kuota',
                'tikets.kategori',
                'tikets.harga'
            )

            ->orderBy('transaksis.tanggal', 'desc')

            ->get();

        /*
        |--------------------------------------------------------------------------
        | DATA FINANCE
        |--------------------------------------------------------------------------
        */

        $financeData = DB::table('transaksis')

            ->join('tikets', 'transaksis.id_tiket', '=', 'tikets.id')

            ->whereIn('transaksis.status', [
                'aktif',
                'expired'
            ])

            ->select(
                'tikets.nama_tiket',

                DB::raw('SUM(transaksis.sub_total) as pendapatan'),

                DB::raw('MAX(transaksis.tanggal) as tanggal')
            )

            ->groupBy('tikets.nama_tiket')

            ->get();

        /*
        |--------------------------------------------------------------------------
        | CHART
        |--------------------------------------------------------------------------
        */

        $chart = DB::table('transaksis')

            ->join('tikets', 'transaksis.id_tiket', '=', 'tikets.id')

            ->whereIn('transaksis.status', [
                'aktif',
                'expired'
            ])

            ->select(
                'tikets.nama_tiket',

                DB::raw('SUM(transaksis.sub_total) as total_pendapatan')
            )

            ->groupBy('tikets.nama_tiket')

            ->get();

        $chartLabels = $chart->pluck('nama_tiket');

        $chartData = $chart->pluck('total_pendapatan');

        return view('laporan', compact(
            'transaksis',
            'financeData',
            'chartLabels',
            'chartData'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD CSV
    |--------------------------------------------------------------------------
    */

    public function downloadExcel()
    {
        $filename = "laporan-finance.csv";

        header('Content-Type: text/csv');

        header(
            'Content-Disposition: attachment; filename="' . $filename . '"'
        );

        $output = fopen('php://output', 'w');

        /*
        |--------------------------------------------------------------------------
        | JUDUL
        |--------------------------------------------------------------------------
        */

        fputcsv($output, ['DATA TIKET & TRANSAKSI']);

        fputcsv($output, []);

        /*
        |--------------------------------------------------------------------------
        | HEADER TRANSAKSI
        |--------------------------------------------------------------------------
        */

        fputcsv($output, [
            'Nama Tiket',
            'Kuota',
            'Kategori',
            'Status',
            'Harga',
            'Tanggal'
        ]);

        /*
        |--------------------------------------------------------------------------
        | DATA TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $transaksis = DB::table('transaksis')

            ->join('tikets', 'transaksis.id_tiket', '=', 'tikets.id')

            ->select(
                'transaksis.status',
                'transaksis.tanggal',

                'tikets.nama_tiket',
                'tikets.kuota',
                'tikets.kategori',
                'tikets.harga'
            )

            ->orderBy('transaksis.tanggal', 'desc')

            ->get();

        foreach ($transaksis as $item) {

            fputcsv($output, [
                $item->nama_tiket,
                $item->kuota,
                $item->kategori,
                $item->status,
                $item->harga,
                $item->tanggal
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | SPASI
        |--------------------------------------------------------------------------
        */

        fputcsv($output, []);
        fputcsv($output, []);

        /*
        |--------------------------------------------------------------------------
        | JUDUL FINANCE
        |--------------------------------------------------------------------------
        */

        fputcsv($output, ['DATA FINANCE']);

        fputcsv($output, []);

        /*
        |--------------------------------------------------------------------------
        | HEADER FINANCE
        |--------------------------------------------------------------------------
        */

        fputcsv($output, [
            'Nama Tiket',
            'Pendapatan',
            'Tanggal'
        ]);

        /*
        |--------------------------------------------------------------------------
        | DATA FINANCE
        |--------------------------------------------------------------------------
        */

        $financeData = DB::table('transaksis')

            ->join('tikets', 'transaksis.id_tiket', '=', 'tikets.id')

            ->whereIn('transaksis.status', [
                'aktif',
                'expired'
            ])

            ->select(
                'tikets.nama_tiket',

                DB::raw('SUM(transaksis.sub_total) as pendapatan'),

                DB::raw('MAX(transaksis.tanggal) as tanggal')
            )

            ->groupBy('tikets.nama_tiket')

            ->get();

        foreach ($financeData as $item) {

            fputcsv($output, [
                $item->nama_tiket,
                $item->pendapatan,
                $item->tanggal
            ]);
        }

        fclose($output);

        exit;
    }
}