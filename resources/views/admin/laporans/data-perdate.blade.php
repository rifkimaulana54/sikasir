
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
    @endif
</table>
<script>
    $(document).ready(function() {
        var total =$('#total-hariIni').val();
        $('#grandtotal').html(total)
    })
</script>
