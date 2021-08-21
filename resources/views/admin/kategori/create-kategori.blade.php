<form action="/kategori/store" method="post" id="form-kategori-baru">
    @csrf
    <div class="form-group">
        <label for="kategori">Nama Kategori</label>
        <input type="text" name="nama_kategori" id="kategori" class="form-control" autocomplete="off">
    </div>
    <div class="float-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="upload" class="btn btn-primary mr-1" value="Submit">
    </div>
</form>

<script>
    $(document).ready(function() {
        newData();
        $('#form-kategori-baru').on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: "/kategori/store",
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
                        $("#kategori").val("");
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

</script>