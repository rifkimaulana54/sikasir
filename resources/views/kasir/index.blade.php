@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="row mb-2">
                <div class="col-md-4">
                    <h4><b>Menu</b></h4>
                </div>
                <div class="col-md-4 d-flex">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div><b>Urut Berdasarkan</b></div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            @foreach ($kategoris as $kategori)
                                <x-dropdown-link style="cursor:pointer; text-decoration: none" onclick="kasirKategori({{$kategori->id}})">
                                    {{$kategori->nama_kategori}}
                                </x-dropdown-link>
                            @endforeach
                            <x-dropdown-link style="cursor:pointer; text-decoration: none" onclick="menuAll()">
                                Tampilkan Senua
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="col-md-4 d-flex">
                    <input style="margin: auto 0 auto 0" type="text" name="search" id="search" placeholder="Cari..." class="form-control" style="width: 250px;" autocomplete="off" />
                    <i class="fas fa-search" style="margin: 10px 0 0 -25px;" for="search"></i>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row" id="data-kasir">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="solds"></div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            soldNew();
            fetch_customer_data();
            function fetch_customer_data(query = ''){
                $.ajax({
                    url: "/kasir/daftar-menu/cari",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data) {
                        $('#data-kasir').html(data.menu_kasir);
                    }
                })
            }

            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                fetch_customer_data(query);
            });
        });

        function menuAll() {
            $.get('/kasir/menu-all', {}, function(data, status){
                $('#data-kasir').html(data);
            });
        }

        function kasirKategori(id){
            $.get("/kasir/menu-perkategori/"+id, {}, function(data, status){
                $('#data-kasir').html(data)
            });
        }

        function selectMenu(id){
            $.get('/select/'+id+'/addCart')
            soldNew();
        }
        
        function updateQuantity(id){
            var val = $('#qty-'+id).val();
            $.ajax('/select/'+id+'/update-qty/'+val)
            soldNew();
        }

        function hapusPesanan(id){
            $.get('/select/'+id+'/delete-pesanan');
            soldNew();
        }

        function reset(){
            $.get('/select/reset-pesanan');
            soldNew();
        }

        
        function soldNew() {
            $.get('/data-new/solds', {}, function(data, status){
                $('#solds').html(data);
            });
        }
        function updatePesanan(){
            var jum_uang      = $('#jum-uang').val();
            var grandtotal    = $('#grandtotal').val();
            var kembalian     = jum_uang - grandtotal
            var number_string = kembalian.toString(),
                sisa   = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                sparator = sisa ? '.' : '';
                rupiah += sparator + ribuan.join('.');
            }
            rupiah = undefined ? rupiah : (rupiah ? 'Rp.'+rupiah :'');

            $('#uang-kembali').html(rupiah);
            // console.log(jum_uang);
        }
        
    </script>
@endsection