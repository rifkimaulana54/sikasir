@extends('admin.template')
@section('title', 'Laporan')
@section('nav-laporan')
    class="active"
@endsection
@section('content')
    <div class="section-header">
        <h1>Laporan Penjualan</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4 style="width: 250px">Table Data Terjual </h4>
                <div class="form-group" style="cursor: pointer; margin: 20px 0 0 auto">
                    <select style="width: 90px" class="form-control form-select-lg mb-3" name="perTahun" required aria-label=".form-select-lg example" id="perTahun">
                        <option value="{{date('Y')}}-">{{date('Y')}}</option>
                        @for ($i = date('Y'); $i > 2010 ; $i--)
                            <option value="{{$i}}-">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group" style="cursor: pointer; margin: 20px 0 0 0">
                    <select style="width: 90px" class="form-control form-select-lg mb-3" name="perBulan" required aria-label=".form-select-lg example" id="perBulan">
                        <option value="">00</option>
                        @for ($i = 1; $i < 10 ; $i++)
                            <option value="0{{$i}}-">0{{$i}}</option>
                        @endfor
                            <option value="11">11</option>
                            <option value="12">12</option>
                    </select>
                </div>
                <div class="form-group" style="cursor: pointer; margin: 20px 0 0 0">
                    <select style="width: 90px" class="form-control form-select-lg mb-3" name="perTanggal" required aria-label=".form-select-lg example" id="perTanggal">
                        <option value="">00</option>
                        @for ($i = 1; $i < 10 ; $i++)
                            <option value="0{{$i}}">0{{$i}}</option>
                        @endfor
                        @for ($i = 11; $i < 32 ; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <button type="button" onclick="submit()" class="btn mr-5 ml-2 btn-sm btn-primary">Ok</button>
                <h4>Pendapatan = <span id="grandtotal">Rp.0</span></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive"  id="data-table">
                    <table class="table">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Terjual</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Tanggal</th>
                            </tr>
                        @if ($solds->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Belum ada menu terjual!</td>
                            </tr>
                        @else
                                <tbody>
                                    @php
                                        $i = 1;
                                        $grandtotal = 0;
                                    @endphp
                                    @foreach ($solds as $sold)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$sold->total_qty}} {{$sold->menu->nama_menu}}</td>
                                            <td>Rp.{{number_format($sold->menu->harga * $sold->total_qty)}}</td>
                                            <td>{{$sold->tanggal->isoFormat('dddd, D MMMM Y')}}</td>
                                        </tr>
                                        @php
                                            $grandtotal += $sold->menu->harga * $sold->total_qty
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <td colspan="3" class="text-right"><b>Total pendapatan</b></td>
                                        <td><b>Rp.{{number_format($grandtotal)}}</b></td>
                                        <input type="hidden" value="Rp.{{number_format($grandtotal)}}" id="total-hariIni">
                                    </tr>
                                </tfoot>
                            {{-- </div> --}}
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var total =$('#total-hariIni').val();
            $('#grandtotal').html(total)
        })
        
        function submit(){
            var tahun = $('#perTahun').val()
            var bulan = $('#perBulan').val()
            var tanggal = $('#perTanggal').val()

            // console.log(tahun+bulan+tanggal);
            $.get('/laporan/select/'+tahun+bulan+tanggal, {}, function(data, status){
                $('#data-table').html(data);
                console.log(tahun+bulan+tanggal);
            })

        }
        
    </script>
@endsection