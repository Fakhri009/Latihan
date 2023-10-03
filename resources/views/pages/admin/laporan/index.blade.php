@extends('layouts.main')
@section('title', 'List Laporan')

@section('content')
    <section class="section custom-section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>List Laporan</h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Laporan</button>
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
                                            
                                            <th>Jumlah Potong</th>
                                            <th>Nama Customer</th>
                                            
                                            <th>Nama Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporan as $result)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $result->jumlah_potong }}</td>
                                                <td>{{ $result->customer->nama_customer }}</td>
                                                <td>{{ $result->produk->nama_produk }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('laporan.edit', $result->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                                        <form method="POST" action="{{ route('laporan.destroy', $result->id) }}">
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
                                <h5 class="modal-title">Tambah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('laporan.store') }}" method="POST">
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
                                                <label for="jumlah_potong">Jumlah Potong</label>
                                                <input type="text" id="jumlah_potong" name="jumlah_potong" class="form-control @error('jumlah_potong') is-invalid @enderror" placeholder="{{ __('Hasil') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="customer_id">Customer</label>
                                                <select id="customer_id" name="customer_id" class="select2 form-control ">
                                                    <option value="">-- Pilih Nama Customer --</option>
                                                    @foreach ($customer as $data)
                                                        <option value="{{ $data->id }}">{{ $data->nama_customer }}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                          
                                            <div class="form-group">
                                                <label for="produk_id">Produk</label>
                                                <select id="produk_id" name="produk_id" class="select2 form-control ">
                                                    <option value="">-- Pilih Nama Produk --</option>
                                                    @foreach ($produk as $data)
                                                        <option value="{{ $data->id }}">{{ $data->nama_produk }}</option>
                                                    @endforeach                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
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
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Yakin ingin menghapus data ini?`,
                text: "Data akan terhapus secara permanen!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                form.submit();
                }
            });
        });
    </script>
@endpush
