@extends('layouts.main')

@section('title', 'List Customer')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Customer</h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Customer</button>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ $message }}
                            </div>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Customer</th>
                                        <th>NIC</th>
                                        <th>Nama Pelayanan</th>
                                        <th>Alamat</th>
                                        <th>No Telp</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer as $result => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_customer }}</td>
                                        <td>{{ $data->nic }}</td>
                                        <td>{{ $data->pelayanan->nama_pelayanan }} | {{ $data->pelayanan->produk->nama_produk }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $data->telp }}</td>
                                        <td>
                                                @if ($data->foto)
                                                    <img src="{{ asset('storage/' . $data->foto) }}" alt="" style="width : 100px;;">
                                                @endif
                                            </td>
                                            <td>
                                            <div class="d-flex">
                                                <a href="{{ route('customer.show', Crypt::encrypt($data->id)) }}" class="btn btn-primary btn-sm" style="margin-right: 8px"><i class="nav-icon fas fa-user"></i> &nbsp; Profile</a>
                                                <a href="{{ route('customer.edit', Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                                <form method="POST" action="{{ route('customer.destroy', $data->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Delete' style="margin-left: 8px"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="row">
                                    <div class="col-md-12">
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
                                        <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                        <div class="form-group">
                                            <label for="nama_customer">Nama Customer</label>
                                            <input type="text" id="nama_customer" name="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror" placeholder="{{ __('Nama Customer') }}" value="{{ old('nama_customer') }}">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                <label for="nic">NIC</label>
                                                <input type="text" id="nic" name="nic" class="form-control @error('nic') is-invalid @enderror" placeholder="{{ __('NIC Customer') }}" value="{{ old('nic') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">No. Telp</label>
                                            <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="{{ __('No. Telp Customer') }}">
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label for="pelayanan_id">Pelayanan</label>
                                            <select id="pelayanan_id" name="pelayanan_id" class="select2 form-control @error('pelayanan_id') is-invalid @enderror">
                                                <option value="">-- Pilih Pelayanan --</option>
                                                @foreach ($pelayanan as $data )
                                                <option value="{{ $data->id }}">{{ $data->nama_pelayanan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}" value="{{ old('alamat') }}"></textarea>
                                        </div>
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
                                </div>
                                <div class="modal-footer br">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Yakin ingin menghapus data ini?`
                , text: "Data akan terhapus secara permanen!"
                , icon: "warning"
                , buttons: true
                , dangerMode: true
            , })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

</script>
@endpush
