<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body onload="window.print();">
    <div style="width: 285px;">
        @php
            use Illuminate\Support\Facades\DB;
            $brand = DB::table('settings')->first();
        @endphp
        <h3  style="text-align: center; margin-bottom: 0"><b>{{$brand->nama_brand}}</b></h3>
        <div style="text-align: center"><small>Jl. Syekh Nurjati Desa Wanasaba Kidul Kec. Talun</small></div>
        <hr>
        <table style="margin: 15px; auto 20px; auto">
            <tbody>
                @php
                    $grandtotal = 0;
                @endphp
                @foreach ($solds as $sold)
                    <tr>
                        <td width="30" style="font-size: 15px; cursor: pointer">
                            {{$sold->quantity}}
                        </td>
                        <td width="130">{{$sold->menu->nama_menu}}</td>
                        <td width="80"><small>Rp. </small> {{number_format($sold->menu->harga * $sold->quantity)}}</td>
                    </tr>
                    @php
                        $grandtotal += $sold->menu->harga * $sold->quantity;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><hr></td>
                </tr>
                <tr>                        
                    <td colspan="2">Total</td>
                    <td>
                        <small>Rp. </small> {{number_format($grandtotal)}} <input type="hidden" id="grandtotal" value="{{$grandtotal}}"> 
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Tunai</td>
                    <td><small>Rp. </small>{{number_format($tunai)}}</td>
                </tr>
                <tr>
                    <td colspan="2">Kembali</td>
                    <td><small>Rp. </small>{{($tunai == 0 ? 0 : number_format($tunai-$grandtotal))}}</td>
                </tr>
            </tfoot>
        </table>
        <hr>
        <h3 style="text-align: center"><b>Terimakasih</b></h3>
    </div>
</body>
</html>