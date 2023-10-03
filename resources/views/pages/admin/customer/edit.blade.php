@extends('layouts.main')

@section('title', 'Edit Customer')

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
                        <h4>Edit Customer {{ $customer->nama_customer }}</h4>
                        <a href="{{ route('customer.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('customer.update', $customer->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="hidden" name="oldImage" value="{{isset($customer->foto) ? $customer->foto : '' }}">
                                @if (isset($customer->foto) ? true : false)
                                    <img src="{{ asset('storage/' . $customer->foto) }}" class="img-preview img-fluid mb-3 col-sm-5">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-sm-5">
                                @endif
                                <label for="foto" class="d-block">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage()">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_customer">Nama Customer</label>
                                <input type="text" id="nama_customer" name="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror" placeholder="{{ __('Nama Customer') }}" value="{{ $customer->nama_customer }}">
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label for="nic">NIC</label>
                                    <input type="text" id="nic" name="nic" class="form-control @error('nic') is-invalid @enderror" placeholder="{{ __('No Customer') }}" value="{{ $customer->nic }}">
                                </div> 
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}">{{ $customer->alamat }}</textarea>
                            </div>
                            <div class="form-group ml-4">
                                <label for="telp">Telp</label>
                                <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="{{ __('No. Telp Customer') }}" value="{{ $customer->telp }}">
                            </div>
                            <div class="form-group">
                                <label for="pelayanan_id">Nama Pelayanan</label>
                                <select id="pelayanan_id" name="pelayanan_id" class="select2bs4 form-control @error('pelayanan_id') is-invalid @enderror">
                                    <option value="">-- Pilih Pelayanan --</option>
                                    @foreach ($pelayanan as $data )
                                    <option value="{{ $data->id }}" @if ($customer->pelayanan_id == $data->id)
                                        selected
                                        @endif
                                        >{{ $data->nama_pelayanan }}</option>
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
