@extends('layout.main')
@section('title', 'Status')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Status</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Status</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- <a href="{{ route('status.create') }}" class="btn btn-md btn-success mb-3"><i class="fas fa-plus"></i> Tambah Data</a> -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @forelse ($status as $item)
                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_status }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('status.destroy', $item->id_status)}}" method="post">
                                    <!-- <a href="{{route('status.edit', $item->id_status)}}" class="btn btn-sm btn-primary">Edit</a> -->
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <div class="alert alert-danger">
                            Data Status belum Tersedia.
                        </div>
                        @endforelse                                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-6">            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Status</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('status.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Status</label>
                            <input type="text" name="nama_status" class="form-control">
                            @error('nama_status')
                                {{$message}}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-warning"> Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection