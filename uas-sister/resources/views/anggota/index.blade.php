@extends('layout.main')
@section('title', 'Users')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar User</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tables</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('anggota.create') }}" class="btn btn-md btn-success mb-3"><i class="fas fa-plus"></i> Tambah User</a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @forelse ($anggota as $users)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->email }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('anggota.destroy', $users->id)}}" method="post">
                                <a href="{{route('anggota.show', $users->id)}}" class="btn btn-sm btn-dark">Show</a>
                                <a href="{{route('anggota.edit', $users->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <div class="alert alert-danger">
                            Data Anggota belum Tersedia.
                        </div>
                        @endforelse                                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection