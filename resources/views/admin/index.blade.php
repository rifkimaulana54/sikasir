@extends('admin.template')
@section('title', 'Dashboard')
@section('nav-dashboard')
    class="active"
@endsection
@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Menu</h4>
                    </div>
                    <div class="card-body">
                        @php
                            use App\Models\Menu;
                        @endphp
                        {{$count_menu = Menu::count();}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pendapatan hari ini</h4>
                    </div>
                    <div class="card-body">
                        @php
                            use App\Models\Sold;
                            $hari_ini = Sold::where('counted', 1)
                                ->where('tanggal', date('Y-m-d'))
                                ->sum('jumlah');
                        @endphp
                        <small><b>Rp.{{number_format($hari_ini)}}</b></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pendapatan bulan ini</h4>
                    </div>
                    <div class="card-body">
                        @php
                            $bulan_ini = Sold::where('counted', 1)
                                ->where('bulan', 'like', '%' . date('Y-m') . '%')
                                ->sum('jumlah');
                        @endphp
                        <small><b>Rp.{{number_format($bulan_ini)}}</b></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pendapatan tahun ini</h4>
                    </div>
                    <div class="card-body">
                        @php
                            $tahun_ini = Sold::where('counted', 1)
                                ->where('bulan', 'like', '%' . date('Y') . '%')
                                ->sum('jumlah');
                        @endphp
                        <small><b>Rp.{{number_format($tahun_ini)}}</b></small>
                    </div>
                </div>
            </div>
        </div>                  
    </div>
    {{-- Chart --}}
    <div class="card shadow">
        <div class="card-body">
            <div class="text-center">
                <b>Pendapatan Perbulan Tahun {{date('Y')}}</b>
            </div>

            <div>
                {!! $incomChart->container() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>


    {!! $incomChart->script() !!}
@endpush