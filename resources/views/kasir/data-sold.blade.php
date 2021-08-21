@if ($solds->isEmpty())
    <div class="card shadow-sm">
        <div class="card-body">
            <h5><b>Memesan</b></h5> <hr>
            <div class="text-center">Belum memesan!</div>
        </div>
    </div>
@else
    <div class="card shadow-sm">
        <div class="card-body">
            <h5><b>Memesan</b></h5> <hr>
            <div class="table table-responsive">
                <table class="table">
                    <tbody>
                        @php
                            $grandtotal = 0;
                        @endphp
                        @foreach ($solds as $sold)
                            <tr>
                                <td width="150" style="font-size: 15px; cursor: pointer">
                                    <button type="button" class="text-primary" onclick="updateQuantity({{$sold->id}})"><i class="fas fa-sync-alt"></i></button>&nbsp;
                                    <input type="text" id="qty-{{$sold->id}}" name="quantity" value="{{$sold->quantity}}" autocomplete="off" style="width: 45px; height:25px">
                                    <input type="hidden" id="id-pesanan-{{$sold->id}}" value="{{$sold->id}}">
                                </td>
                                <td  width="150">{{$sold->menu->nama_menu}}</td>
                                <td class="text-right">{{number_format($sold->menu->harga * $sold->quantity)}}</td>
                                <td width="20" class="text-right" style="cursor: pointer" onclick="hapusPesanan({{$sold->id}})"><b class="text-danger">x</b></td>
                            </tr>
                            @php
                                $grandtotal += $sold->menu->harga * $sold->quantity;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>                        
                            <td colspan="2">Total</td>
                            <td class="text-right">
                                <small>Rp.</small>{{number_format($grandtotal)}} <input type="hidden" id="grandtotal" value="{{$grandtotal}}"> 
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">Jumlah Uang</td>
                            <td class="text-right"><input id="jum-uang" class="text-right" type="text" style="width: 90px; height:25px"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">Kembali</td>
                            <td class="text-right" id="uang-kembali"></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-2 float-right">
        <button onclick="reset()" class="btn btn-sm btn-danger" type="submit">reset</button> &nbsp;
        <button onclick="updatePesanan()" class="btn btn-sm btn-primary">update</button> &nbsp;
        <button class="btn btn-sm btn-success" type="submit">print</button>
    </div>
@endif
