<form action="/daftar-menu/{{$menu->id}}/update" method="post" id="form-edit-menu" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="gambar">Gambar</label><br>
        <div class="my-2">
            <img id="previewImg" src="{{asset('image/menu/'.$menu->gambar)}}" style="width: 80px;" class="img-fluid"/>
        </div>
        <input type="file" name="gambar" onchange="preview()" id="gambar" class="form-control-input" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <select class="form-control form-select-lg mb-3" name="kategori" required aria-label=".form-select-lg example" id="kategori">
            <option value="{{$menu->kategori->id}}">{{$menu->kategori->nama_kategori}}</option>
            @foreach ($kategoris as $id => $kategori)
                <option value="{{ $kategori->id }}"> 
                    {{ $kategori->nama_kategori}} 
                </option>
            @endforeach   
        </select>
    </div>
    <div class="form-group">
        <input type="hidden" name="id" id="id-menu" value="{{$menu->id}}">
        <label for="nama_menu">Nama Menu</label>
        <input type="text" name="nama_menu" id="nama_menu" value="{{$menu->nama_menu}}" class="form-control" id="nama_menu" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="text" name="harga" id="harga" value="{{$menu->harga}}" class="form-control" id="harga" autocomplete="off">
    </div>
    <div class="float-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="upload" class="btn btn-primary mr-1" value="Submit">
    </div>
</form>


<script>
    $(document).ready(function() {
        newData();
        var id_menu = $('#id-menu').val();
        $('#form-edit-menu').on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: "/daftar-menu/"+id_menu+"/update",
                method: "POST",
                data:new FormData(this),
                dataType: "JSON",
                contentType: false,
                cache: false,
                processData: false,
                success:function(data) {
                    if($.isEmptyObject(data.error)){
                        newData();
                        $('.close-modal').click();
                        $('.err-close').click();
                        $('#success').html('<div class="alert alert-success"><button type="button" class="close" id="success-close" data-dismiss="alert">x</button><b>'+data.success+'</b></div>');
                    } else {
                        newData();
                        $('.close-modal').click();
                        $('#success-close').click();
                        errorMessage(data.error);
                    }
                }
            });
            function errorMessage(msg) {
                $('#title-error').html('Gagal membuat kategori baru!')
                $("#error").find("ul").html('');
                $("#error").css('display','block');
                $.each( msg, function( key, value ) {
                    $("#error").find("ul").append('<li>'+value+'</li>');
                });
            }
        })
    });

    function preview() {
        document.getElementById('previewImg').src = URL.createObjectURL(event.target.files[0])
    }
    
    function newData(){
        $.get("/daftar-menu/new-data", {}, function(data, status){
            $('#new_data').html(data)
        });
    }
</script>