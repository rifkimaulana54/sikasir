<div class="card shadow">
    <div class="card-body">
        <form action="/setting/{{$setting->id}}/update" method="post" id="form-edit-setting" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="logo">Logo</label><br>
                <div class="my-2">
                    <img id="previewImg" src="{{asset('image/'.$setting->logo)}}" style="width: 80px;" class="img-fluid"/>
                </div>
                <input type="file" name="logo" onchange="preview()" id="logo" class="form-control-input" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="nama_brand">Nama Brand</label>
                <input type="text" name="nama_brand" id="nama_brand" value="{{$setting->nama_brand}}" class="form-control" id="nama_brand" autocomplete="off">
                <input type="hidden" value="{{$setting->id}}" id="id-sett">
            </div>
            <div class="float-right">
                <input type="submit" name="upload" class="btn btn-primary mr-1" value="Update">
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        newDataSett();
        var id_setting = $('#id-sett').val();
        $('#form-edit-setting').on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: "/setting/"+id_setting+"/update",
                method: "POST",
                data:new FormData(this),
                dataType: "JSON",
                contentType: false,
                cache: false,
                processData: false,
                success:function(data) {
                    if($.isEmptyObject(data.error)){
                        newDataSett();
                        $('#success').html('<div class="alert alert-success"><button type="button" class="close" id="success-close" data-dismiss="alert">x</button><b>'+data.success+'</b></div>');
                    } else {
                        newDataSett();
                        $('#success-close').click();
                        errorMessage(data.error);
                    }
                }
            });
            function errorMessage(msg) {
                $('#title-error').html('Gagal update!')
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
    
    function newDataSett(){
        $.get("/setting/new-data", {}, function(data, status){
            $('#new-data-sett').html(data)
        });
    }
</script>