<div class="card">
    <div class="card-header">
        <h4 class="mr-4">Table Daftar Menu</h4>
    </div>
    <div class="card-body">
        @if ($menus->isEmpty())
            <div class="text-center">Tidak ada menu!</div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table">
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Menu</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i =1;
                        @endphp
                            @foreach ($menus as $menu)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><img src="{{asset('image/menu/'.$menu->gambar)}}" alt="" width="50" height="50"></td>
                                <td>{{$menu->nama_menu}}</td>
                                <td>{{$menu->kategori->nama_kategori}}</td>
                                <td>Rp. {{number_format($menu->harga)}}</td>
                                <td class="text-center">
                                    <span class="btn btn-primary btn-sm" onclick="editMenu({{$menu->id}})"><i class="fas fa-edit"></i></span>
                                    <span class="btn btn-danger btn-sm" onclick="hapusMenu({{$menu->id}})"><i class="fas fa-trash"></i></span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>