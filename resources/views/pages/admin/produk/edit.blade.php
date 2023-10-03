@extends('layouts.main')
@section('title', 'Edit Produk')

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
                    <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit Produk {{ $produk->nama_produk }}</h4>
                        <a href="{{ route('produk.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_produk">Nama produk</label>
                                <input type="text" id="nama_produk" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="{{ __('Nama produk') }}" value="{{ $produk->nama_produk ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="pcs">Pcs</label>
                                <input type="text" id="pcs" name="pcs" class="form-control @error('pcs') is-invalid @enderror" placeholder="{{ __('Nama produk') }}" value="{{ $produk->pcs ?? '' }}">
                            </div>
                                    <div class="form-group">
                                        <input type="hidden" name="oldImage" value="{{isset($produk->foto) ? $produk->foto : '' }}">
                                        @if (isset($produk->foto) ? true : false)
                                            <img src="{{ asset('storage/' . $produk->foto) }}" class="img-preview img-fluid mb-3 col-sm-5">
                                        @else
                                            <img class="img-preview img-fluid mb-3 col-sm-5">
                                        @endif
                                        <label for="foto" class="d-block">Foto</label>
                                        <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage()">
                                        </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="{{ __('Nama produk') }}" value="{{ $produk->harga ?? '' }}">
                            </div>
                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan Perubahan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
