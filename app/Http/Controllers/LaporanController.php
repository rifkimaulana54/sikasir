<?php

namespace App\Http\Controllers;

use App\Models\Sold;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $solds = Sold::with('menu')
            ->where('counted', 1)
            ->where('tanggal', 'like', '%' . date('Y-m-d') . '%')
            ->select(DB::raw('SUM(quantity) as total_qty, menu_id, tanggal'))
            ->groupBy('menu_id', 'tanggal')
            ->get();
        return view('admin.laporans.index', compact('solds'));
    }

    public function getPerdate($date)
    {
        $solds = Sold::with('menu')
            ->where('counted', 1)
            ->where('tanggal', 'like', '%' . $date . '%')
            ->select(DB::raw('SUM(quantity) as total_qty, menu_id, tanggal'))
            ->groupBy('menu_id', 'tanggal')
            ->get();
        return view('admin.laporans.data-perdate', compact('solds'));
    }
}
