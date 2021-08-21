@extends('admin.template')
@section('title', 'Daftar Menu')
@section('nav-daftar-menu')
    class="active"
@endsection
@section('content')
    <div class="section-header">
        <h1>Daftar Menu</h1>
    </div>

    <div class="section-body">
        <div class="row mb-3">
            <div class="col-md-6 mb-1">
                <button style="width: 100%;"  class="btn btn-primary" onclick="menuBaru()"> 
                    <i class="fas fa-plus"></i> Menu Baru
                </button>
            </div>
            <div class="col-md-6">
                <button style="width: 100%;" href="#" class="btn btn-warning" onclick="kategoriBaru()">
                    <i class="fas fa-plus"></i> Katgeori Baru
                </button>
            </div>
        </div>
        <div class="container-fluid">
            <div id="success"></div>
            <div class="alert alert-danger alert-dismissible show fade" id="error" style="display:none">
                <div class="alert-body">
                    <button class="close err-close" data-dismiss="alert"><span>&times;</span></button>
                    <b id="title-error"></b>
                    <ul></ul>
                </div>
            </div>
            <div id="new_data">

            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-menuBaru">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus"></i> Buat Menu Baru</h5>
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('js/kategori/kategori.js')}}"></script>
@endsection