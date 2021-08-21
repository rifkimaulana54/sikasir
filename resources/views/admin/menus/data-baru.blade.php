<div class="row">
    <div class="col-md-9" id="data-kategori">
        <div class="card">
            <div class="card-header">
                <h4 class="mr-4">Table Daftar Menu</h4>
                <div class="col-md d-flex">
                    <input style="margin: auto 0 auto 0" type="text" name="search" id="search" placeholder="Cari..." class="form-control" style="width: 250px;" autocomplete="off" />
                    <i class="fas fa-search" style="margin: 10px 0 0 -25px;" for="search"></i>
                </div>
                <h4 class="ml-4">Total Menu = <span id="total-menu"></span></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr class="table">
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Menu</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tbody id="data-table">
                            {{-- @php
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
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4>Katgeori</h4>
            </div>
            @if ($kategoris->isEmpty())
                <div class="card-body">
                    <div class="text-center">Belum ada kategori!</div>
                </div>
                @else
                    <div>
                        <table class="table">
                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <td class="text-primary" style="cursor: pointer;" width="130"><b onclick="kategori({{$kategori->id}})">{{$kategori->nama_kategori}}</b></td>
                                    <td>
                                        <span class="text-primary" style="cursor: pointer;" onclick="editKategori({{$kategori->id}})"><i class="fas fa-edit"></i></span> &nbsp;
                                        <span class="text-danger" style="cursor: pointer;" onclick="hapusKategori({{$kategori->id}})"><i class="fas fa-window-close"></i></span>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-primary" style="cursor: pointer;" colspan="2"><b onclick="allData()">Tampilkan Semua</b></td>
                            </tr>
                        </table>
                    </div>
                @endif
        </div>
    </div>
</div>
<script>
    function kategori(id) {
        $.get("/daftar-menu/new-data/"+id, {}, function(data, status){
            $('#data-kategori').html(data)
        });
    }
    function allData(){
        $.get("/daftar-menu/new-data/", {}, function(data, status){
            $('#new_data').html(data)
        });
    }

    $(document).ready(function(){
        fetch_customer_data();
        function fetch_customer_data(query = ''){
            $.ajax({
                url: "/daftar-menu/new-data/cari",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data) {
                    $('#data-table').html(data.table_data);
                    $('#total-menu').html(data.total_data);
                }
            })
        }

        $(document).on('keyup', '#search', function(){
            var query = $(this).val();
            fetch_customer_data(query);
        });
    });
</script>