@extends('admin.template')
@section('title', 'Setting')
@section('nav-setting')
    class="active"
@endsection
@section('content')
    <div class="section-header">
        <h1>Setting App</h1>
    </div>

    <div class="section-body">
        <div id="success"></div>
        <div class="alert alert-danger alert-dismissible show fade" id="error" style="display:none">
            <div class="alert-body">
                <button class="close err-close" data-dismiss="alert"><span>&times;</span></button>
                <b id="title-error"></b>
                <ul></ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="table">
                                        <th>Logo</th>
                                        <th>Nama Brand</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="new-data-sett">
                                    <tr>
                                        <td>
                                            <img src="{{asset('image/'.$setting->logo)}}" style="width: 50px;" class="img-fluid rounded-circle"/>
                                        </td>
                                        <td>{{$setting->nama_brand}}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" onclick="editSetting({{$setting->id}})">Edit</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md4" id="edit-setting">

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function editSetting(id) {
            $.get('/admin/setting/'+id, {}, function(data, status) {
                $('#edit-setting').html(data);
            });
        }
    </script>
@endsection