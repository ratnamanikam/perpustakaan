@extends('layout.main')
@section('title', 'Buku')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Buku</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tables</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('buku.create') }}" class="btn btn-md btn-success mb-3"><i class="fas fa-plus"></i> Tambah Data</a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>ISBN</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @forelse ($buku as $item)
                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td><img src="{{ asset('storage/' . str_replace('gambar/', '', $item->gambar)) }}" alt="{{ $item->judul }}" width="50"></td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->penulis }}</td>
                            <td>{{ $item->isbn }}</td>
                            <td>{{ $item->tahun_terbit }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('buku.destroy', $item->id_buku)}}" method="post">
                                    <a href="{{route('buku.edit', $item->id_buku)}}" class="btn btn-sm btn-primary">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <div class="alert alert-danger">
                            Data Buku belum Tersedia.
                        </div>
                        @endforelse                                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection