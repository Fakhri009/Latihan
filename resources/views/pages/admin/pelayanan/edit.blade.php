@extends('layouts.main')
@section('title', 'Edit Pelayanan')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Edit Nama Pelayanan</h4>
                            <a href="{{ route('pelayanan.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('pelayanan.update', $pelayanan->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama_pelayanan">Nama Pelayanan</label>
                                    <input type="text" id="nama_pelayanan" name="nama_pelayanan" class="form-control @error('nama_pelayanan') is-invalid @enderror" placeholder="{{ __('Nama Pelayanan') }}" value="{{ $pelayanan->nama_pelayanan }}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_model">Nama Model</label>
                                    <input type="text" id="nama_model" name="nama_model" class="form-control @error('nama_model') is-invalid @enderror" placeholder="{{ __('Nama Pelayanan') }}" value="{{ $pelayanan->nama_pelayanan }}">
                                </div>
                                <div class="form-group">
                                    <label for="produk_id">Nama Produk</label>
                                    <select id="produk_id" name="produk_id" class="select2bs4 form-control @error('produk_id') is-invalid @enderror">
                                        <option value="">-- Pilih Nama Produk --</option>
                                        @foreach ($produk as $data )
                                            <option value="{{ $data->id }}"
                                         
                                        >{{ $data->nama_produk }}</option>
                                        @endforeach
                                    </select>
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
