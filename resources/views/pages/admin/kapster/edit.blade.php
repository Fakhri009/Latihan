@extends('layouts.main')
@section('title', 'Edit Kapster
')

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
                            <h4>Edit Kapster {{ $kapster->nama_kapster }}</h4>
                            <a href="{{ route('kapster.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('kapster.update', $kapster->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <img src="{{ asset('img/kapster/'.$kapster->foto) }}" style="width: 120px" alt="foto kapster">
                                <div class="form-group">
                                    <label for="foto">Foto Kapster</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="foto" type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto">
                                            <label class="custom-file-label" for="foto">Pilih file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_kapster">Nama Kapster</label>
                                    <input type="text" id="nama_kapster" name="nama_kapster" class="form-control @error('nama_kapster') is-invalid @enderror" placeholder="{{ __('Nama Kapster') }}" value="{{ $kapster->nama_kapster }}">
                                </div>
                                <div class="d-flex">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="{{ __('NIK Kapster') }}" value="{{ $kapster->nik }}">
                                    </div>
                                    <div class="form-group ml-4">
                                        <label for="telp">Telp</label>
                                        <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="{{ __('No. Telp Kapster') }}" value="{{ $kapster->telp }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}">{{ $kapster->alamat }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="laporan_id">Jumlah Potong</label>
                                    <select id="laporan_id" name="laporan_id" class="select2bs4 form-control @error('laporan_id') is-invalid @enderror">
                                        <option value="">-- Pilih Jumlah Potong --</option>
                                        @foreach ($laporan as $data )
                                            <option value="{{ $data->id }}"
                                         
                                        >{{ $data->jumlah_potong }}</option>
                                        @endforeach
                                    </select>
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
