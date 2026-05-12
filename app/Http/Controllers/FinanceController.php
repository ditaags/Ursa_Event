<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        $tikets = DB::table('tikets')->get();

        $transaksis = DB::table('transaksis')->get();

        $finances = DB::table('finance')->get();

        return view('laporan', compact(
            'tikets',
            'transaksis',
            'finances'
        ));
    }
}