$(document).ready(function() {
    newData();
})
function menuBaru(){
    $('.modal-title').html('<i class="fas fa-plus"></i> Buat Menu Baru')
    $('#modal-menuBaru').modal('show');
    $.get('/menu-baru/create', {}, function(data, status) {
        $('.modal-body').html(data);
    })
}


function editMenu(id){
    $('#modal-menuBaru').modal('show');
    $('.modal-title').html('<i class="fas fa-edit"></i> Edit Menu')
    $.get('/daftar-menu/edit/'+id, {}, function(data, status) {
        $('.modal-body').html(data);
    })
}

function kategoriBaru(){
    $('#modal-menuBaru').modal('show');
    $('.modal-title').html('<i class="fas fa-plus"></i> Buat Kategori Baru')
    $.get('/kategori/create', {}, function(data, status) {
        $('.modal-body').html(data);
    })

}

function editKategori(id){
    $('#modal-menuBaru').modal('show');
    $('.modal-title').html('<i class="fas fa-edit"></i> Edit Kategori')
    $.get('/kategori/edit/'+id, {}, function(data, status) {
        $('.modal-body').html(data);
    })
}

function hapusKategori(id) {
    swal({
        title: "Yakin ingin hapus kategori?",
        text: "Klik Ok untuk lanjut hapus!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "kategori/"+id+"/delete",
                type: "GET",
                contentType: false,
                cache: false,
                processData: false,
                success:function(data) {
                    $('#success').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button><b>'+data.success+'</b></div>');
                }
            });
            newData();
        }
    });
}

function hapusMenu(id) {
    swal({
        title: "Yakin ingin hapus menu?",
        text: "Klik Ok untuk lanjut hapus!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "daftar-menu/"+id+"/delete",
                type: "GET",
                contentType: false,
                cache: false,
                processData: false,
                success:function(data) {
                    $('#success').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">x</button><b>'+data.success+'</b></div>');
                }
            });
            newData();
        }
    });
}

function newData(){
    $.get("/daftar-menu/new-data/", {}, function(data, status){
        $('#new_data').html(data)
    });
}