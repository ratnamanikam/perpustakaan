@extends('layout.main')
@section('title', 'anggota.create')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>

    <div class="row">
        <div class="col-6">            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('anggota.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control">
                            @error('email')
                                {{$message}}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-md btn-warning">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>   
@endsection