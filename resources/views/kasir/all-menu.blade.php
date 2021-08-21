@if ($menus->isEmpty())
    <div class="text-center">Tidak ada menu!</div>
@else
    @foreach ($menus as $menu)
        <div class="col-2 mb-4 text-center">
            <a class="text-dark text-decoration-none" onclick="selectMenu({{$menu->id}})" style="cursor: pointer">
                <img src="{{url("image/menu/" . $menu->gambar)}}"width="90" class="mr-1 ml-auto mr-auto">
                <small>{{$menu->nama_menu }}</small>
            </a>
        </div>
    @endforeach
@endif