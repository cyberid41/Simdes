@extends('layouts.default')
@section('title','Rincian Obyek Barang - Standar Satuan Harga')
@section('style')
@stop
@section('content')
{{-- content start here--}}
<section class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                @if(Auth::user()->is_admin != 100)
                @else
                <li>
                    <a class="" href="{{ URL::to('data-kelas-barang') }}">Kelas</a>
                </li>
                <li>
                    <a class="" href="{{ URL::to('data-kelompok-barang') }}">Kelompok</a>
                </li>
                <li>
                    <a class="" href="{{ URL::to('data-jenis-barang') }}">Jenis</a>
                </li>
                <li>
                    <a class="" href="{{ URL::to('data-obyek-barang') }}">Obyek</a>
                </li>
                @endif
                <li class="active">Barang</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-block alert-danger fade in " id="alert-notify" style="display:none">
                <button data-dismiss="alert" class="close close-sm fa fa-times" type="button"></button>
            </div>
            <section class="panel">
                <header class="panel-heading">
                    <div class="ellipsis">Standar Satuan Harga</div>
                        <span id="form-cari" class="tools pull-right">
                            <input id="cari" type="text" class="form-control tooltips input-widget" placeholder="Cari : Barang"
                                   onfocus="this.select()"
                                   data-original-title="Ketikan data yang ingin dicari, kemudian tekan [Enter]"
                                   data-placement="top">
                        </span>
                </header>
                <div class="panel-body minimal">
                    <div id="form-option" class="mail-option">
                        <button id="btn-tambah" data-original-title="Tambah" data-placement="top"
                                class="btn btn-sm btn-primary tooltips"><i class=" fa fa-plus-square"></i>
                        </button>
                        <button id="btn-refresh" data-original-title="Refresh" data-placement="top"
                                class="btn btn-sm btn-white tooltips"><i class=" fa fa-refresh"></i>
                        </button>
                        <ul class="inbox-pagination">
                            <li><span id="infopage"></span></li>
                            <button id="awal" disabled="disabled" class="btn btn-sm  btn-white tooltips"  data-original-title="Awal" data-placement="top"><i
                                    class="fa fa-angle-double-left"></i></button>
                            <button id="mundur" disabled="disabled" class="btn  btn-sm btn-white tooltips"  data-original-title="Sebelumnya" data-placement="top"><i
                                    class="fa fa-chevron-left"></i></button>
                            <button id="maju" disabled="disabled" class="btn  btn-sm btn-white tooltips"  data-original-title="Berikutnya" data-placement="top"><i
                                    class="fa  fa-chevron-right"></i></button>
                            <button id="akhir" disabled="disabled" class="btn  btn-sm btn-white tooltips"  data-original-title="Akhir" data-placement="top"><i
                                    class="fa  fa-angle-double-right"></i></button>
                        </ul>
                    </div>
                    {{ Form::open(['onsubmit' => 'return false', 'id' => 'myForm', 'class' => 'form-horizontal', 'role'
                    => 'form','style' => 'display:none;']) }}
                    {{ Form::hidden('id', '',['id' => 'id','name' => 'id']) }}
                    {{ Form::hidden('','tambah',['id' => 'cmd']) }}
                    {{ Form::hidden('', $data->getLastPage(),['id' => 'last_page']) }}
                    {{ Form::hidden('', $data->getCurrentPage(),['id' => 'current_page']) }}
                    {{ Form::hidden('', $data->getTotal(),['id' => 'total']) }}
                    {{ Form::hidden('', $data->getTo(),['id' => 'to']) }}
                    {{ Form::hidden('obyek_id','',['id' => 'obyek_id']) }}

                    <div class="form-group">
                        {{ Form::label('kelas', 'Kelas',['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-5">
                            {{ Form::select('kelas', ['' => ''],'',['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('kelompok', 'Kelompok',['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-5">
                            {{ Form::select('kelompok', ['' => ''],'',['class' => 'form-control','disabled' =>
                            'disabled'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('jenis', 'Jenis',['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-3">
                            {{ Form::select('jenis', ['' => ''],'',['class' => 'form-control','disabled' => 'disabled'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('obyek', 'Obyek',['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-3">
                            {{ Form::select('obyek', ['' => ''],'',['class' => 'form-control','disabled' => 'disabled'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('kode_rekening', 'Kode', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-3">
                            {{ Form::text('kode_rekening', '',['class' =>
                            'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('rincian_obyek', 'Rincian Obyek', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('rincian_obyek', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('spesifikasi', 'Spesifikasi', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('spesifikasi', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('satuan', 'Satuan', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('satuan', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('harga', 'Harga', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('harga', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            {{ Form::button('Simpan', ['class' => 'btn btn-primary','id' =>'btn-simpan','type' =>
                            'submit']) }}
                            {{ Form::button('Batal', ['class' => 'btn btn-default','id' =>'btn-batal',]) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                    <section id="flip-scroll">
                        <div id="tab-content">
                            <table class="table table-striped table-condensed cf">
                                <thead class="cf">
                                <tr>
                                    <th>Kode Rekening</th>
                                    <th>Obyek</th>
                                    <th>Rincian Obyek</th>
                                    <th>Satuan</th>
                                    <th class="text-right">Harga</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody id="datalist">
                                    @foreach($data as $dt)
                                    <tr>
                                        <td>{{$dt->kode_rekening}}</td>
                                        <td>{{$dt->obyek->obyek}}</td>
                                        <td>{{$dt->rincian_obyek}}</td>
                                        <td>{{$dt->satuan}}</td>
                                        <td class="text-right">{{number_format( $dt->harga, 0 , '' , '.' )}}</td>
                                        <td>
                                            <div class='btn-toolbar'>
                                                <button class="btn btn-sm btn-default"
                                                        onclick="EditData({{$dt->id}})"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger" onclick="HapusData({{$dt->
                                                    id}})"><i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>
</section>
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
                Yakin akan menghapus data ini?
                {{ Form::hidden('id_hapus', '',['id' => 'id_hapus','name' => 'id_hapus']) }}
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
                <button class="btn btn-warning" type="button" onclick="AksiHapus();"> Hapus</button>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script>
    var url = "{{URL::to('data-rincian-obyek-barang')}}";
    var url_kelas_barang = "{{URL::to('ajax-list-kelas-barang')}}";
    var url_kelompok_barang = "{{URL::to('ajax-list-kelompok-barang')}}";
    var url_jenis_barang = "{{URL::to('ajax-list-jenis-barang')}}";
    var url_obyek_barang = "{{URL::to('ajax-list-obyek-barang')}}";
</script>
{{ HTML::script('app/ssh/data-rincian-obyek-barang.js') }}
{{ HTML::script('app/main-script.js') }}
@stop
