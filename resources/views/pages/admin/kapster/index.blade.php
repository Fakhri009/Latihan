@extends('layouts.main')
@section('title', 'List Kapster')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Kapster</h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Kapster</button>
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
                                        <th>Nama Kapster</th>
                                        <th>NIK</th>
                                        <th>jumlah_potong</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kapster as $result => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_kapster }}</td>
                                        <td>{{ $data->nik }}</td>
                                        <td>{{ $data->laporan->jumlah_potong }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>
                                            @if ($data->foto)
                                                <img src="{{ asset('storage/' . $data->foto) }}" alt="" style="width : 100px;;">
                                            @endif
                                        </td>
                                        <td>
                                          
                                            <div class="d-flex">
                                                <a href="{{ route('kapster.show', Crypt::encrypt($data->id)) }}" class="btn btn-primary btn-sm" style="margin-right: 8px"><i class="nav-icon fas fa-user"></i> &nbsp; Profile</a>
                                                <a href="{{ route('kapster.edit', Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                                <form method="POST" action="{{ route('kapster.destroy', $data->id) }}">
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
                            <h5 class="modal-title">Tambah Kapster</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('kapster.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                                        <div class="form-group">
                                            <label for="nama_kapster">Nama Kapster</label>
                                            <input type="text" id="nama_kapster" name="nama_kapster" class="form-control @error('nama_kapster') is-invalid @enderror" placeholder="{{ __('Nama Kapster') }}">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                <label for="nik">NIK</label>
                                                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="{{ __('NIK Kapster') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">No. Telp</label>
                                                <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="{{ __('No. Telp Kapster') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="laporan_id">Jumlah Potong</label>
                                            <select id="laporan_id" name="laporan_id" class="select2 form-control @error('laporan_id') is-invalid @enderror">
                                                <option value="">-- Pilih laporan --</option>
                                                @foreach ($laporan as $data )
                                                <option value="{{ $data->id }}">{{ $data->jumlah_potong }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="oldImage" value="{{isset($kapster->foto) ? $kapster->foto : '' }}">
                                            @if (isset($kapster->foto) ? true : false)
                                                <img src="{{ asset('storage/' . $kapster->foto) }}" class="img-preview img-fluid mb-3 col-sm-5">
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
