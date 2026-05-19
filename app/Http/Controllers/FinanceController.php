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
        | DATA TIKET
        |--------------------------------------------------------------------------
        */

        $tikets = DB::table('tikets')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $transaksis = DB::table('transaksis')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA FINANCE
        |--------------------------------------------------------------------------
        */

        $financeData = DB::table('transaksis')
            ->join('tikets', 'transaksis.id_tiket', '=', 'tikets.id')
            ->where('transaksis.status', 'aktif')
            ->select(
                'tikets.nama_tiket',
                DB::raw('SUM(transaksis.sub_total) as total_subtotal'),
                DB::raw('MAX(transaksis.tanggal) as tanggal')
            )
            ->groupBy('tikets.nama_tiket')
            ->get()
            ->map(function ($item) {

                $total = $item->total_subtotal;

                return (object)[
                    'nama_tiket'         => $item->nama_tiket,
                    'bagian_super_admin' => $total * 0.5,
                    'bagian_admin'       => $total * 0.5,
                    'tanggal'            => $item->tanggal
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | DATA CHART
        |--------------------------------------------------------------------------
        */

        $chart = DB::table('transaksis')
            ->join('tikets', 'transaksis.id_tiket', '=', 'tikets.id')
            ->where('transaksis.status', 'aktif')
            ->select(
                'tikets.nama_tiket',
                DB::raw('COUNT(*) as total_terjual')
            )
            ->groupBy('tikets.nama_tiket')
            ->get();

        $chartLabels = $chart->pluck('nama_tiket');

        $chartData = $chart->pluck('total_terjual');

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('laporan', compact(
            'tikets',
            'transaksis',
            'financeData',
            'chartLabels',
            'chartData'
        ));
    }
}