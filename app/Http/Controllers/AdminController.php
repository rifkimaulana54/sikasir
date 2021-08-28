<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Charts\IncomChart;
use App\Models\Sold;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->user()->hasRole('admin')) {
            $dataCharts = Sold::with('menu')
                ->where('counted', 1)
                ->select(DB::raw('SUM(jumlah) as total, bulan'))
                ->groupBy('bulan')->get();

            $name_month = [
                '01' => 'Januray', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
            ];

            $solds = [];
            $bln = [];
            foreach ($dataCharts as $dataChart) {
                $solds[] = $dataChart->total;
                $bln[] = strtolower($name_month[date('m', strtotime($dataChart->bulan))]);
            }
            $array = array('data_bln' => $bln, 'data_sold' => $solds);
            $incomChart = new IncomChart;
            $incomChart->labels($array['data_bln']);
            $incomChart->dataset('Pendapatan', 'line', $array['data_sold']);

            return view('admin.index', compact('incomChart'));
        } else {
            return redirect('/login');
        }
    }
}
