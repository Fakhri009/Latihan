@extends('layouts.main')
@section('title', 'Edit Barang')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        @foreach ($errors->all() as $error )
                        {{ $error }}
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('barang.update', $barang->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit Barang {{ $barang->nama_barang }}</h4>
                        <a href="{{ route('barang.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('barang.update', $barang->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" id="nama_barang" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="{{ __('Nama barang') }}" value="{{ $barang->nama_barang ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="pcs">Pcs</label>
                                <input type="text" id="pcs" name="pcs" class="form-control @error('pcs') is-invalid @enderror" placeholder="{{ __('Nama barang') }}" value="{{ $barang->pcs ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="{{ __('Nama barang') }}" value="{{ $barang->harga ?? '' }}">
                            </div>

                                    <div class="form-group">
                                        <input type="hidden" name="oldImage" value="{{isset($barang->foto) ? $barang->foto : '' }}">
                                        @if (isset($barang->foto) ? true : false)
                                            <img src="{{ asset('storage/' . $barang->foto) }}" class="img-preview img-fluid mb-3 col-sm-5">
                                        @else
                                            <img class="img-preview img-fluid mb-3 col-sm-5">
                                        @endif
                                        <label for="foto" class="d-block">Foto</label>
                                        <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage()">
                                        </div>
                            
                            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
