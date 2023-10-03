@extends('layouts.main')
@section('title', 'Edit Laporan')

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
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Edit Laporan {{ $laporan->jumlah_potong }}</h4>
                            <a href="{{ route('laporan.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('laporan.update', $laporan->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="jumlah_potong">Jumlah Potong</label>
                                    <input type="text" id="jumlah_potong" name="jumlah_potong" class="form-control @error('jumlah_potong') is-invalid @enderror" placeholder="{{ __('Jumlah Laporan') }}" value="{{ $laporan->jumlah_potong }}">
                                </div>
                                <div class="form-group">
                                <label for="kapster_id">Kapster</label>
                                <select id="kapster_id" name="kapster_id" class="select2 form-control ">
                                    <option value="">-- Pilih Nama Kapster --</option>
                                    @foreach ($kapster as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kapster }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="customer_id">Nama Customer</label>
                                    <select id="customer_id" name="customer_id" class="select2bs4 form-control @error('customer_id') is-invalid @enderror">
                                        <option value="">-- Pilih Nama Customer --</option>
                                        @foreach ($customer as $data )
                                            <option value="{{ $data->id }}"
                                            @if ($laporan->customer_id == $data->id)
                                                selected
                                            @endif
                                        >{{ $data->nama_customer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="produk_id">Nama Produk</label>
                                    <select id="produk_id" name="produk_id" class="select2bs4 form-control @error('produk_id') is-invalid @enderror">
                                        <option value="">-- Pilih Nama Produk --</option>
                                        @foreach ($produk as $data )
                                            <option value="{{ $data->id }}"
                                            @if ($laporan->produk_id == $data->id)
                                                selected
                                            @endif
                                        >{{ $data->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga Potong</label>
                                    <input type="text" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="{{ __('Harga Potong') }}">
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
