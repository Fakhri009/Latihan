@extends('layouts.main')
@section('title', 'List Barang')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Barang</h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Barang</button>
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
                                        <th>Nama Barang</th>
                                        <th>Pcs</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $result => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td>{{ $data->pcs }}</td>
                                        <td>{{ $data->harga }}</td>
                                        <td>
                                            @if ($data->foto)
                                                <img src="{{ asset('storage/' . $data->foto) }}" alt="" style="width : 100px;;">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('barang.edit', $data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                                <form method="POST" action="{{ route('barang.destroy', $data->id) }}">
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
                            <h5 class="modal-title">Tambah Barang</h5>
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
                                        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <input type="text" id="nama_barang" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="{{ __('Nama Barang') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pcs">Pcs</label>
                                            <input type="text" id="pcs" name="pcs" class="form-control @error('pcs') is-invalid @enderror" placeholder="{{ __('Pcs') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="text" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="{{ __('Harga') }}">
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
