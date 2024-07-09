@extends('layout.main')
@section('title', 'anggota.edit')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Edit User</h1>

    <div class="row">
        <div class="col-6">            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Data</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('anggota.update', $anggota->id)}}" method="post">
                        @csrf
                        @method('PUT')                  
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $anggota->name) }}">
                            @error('name')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control" value="{{ old('email', $anggota->email) }}">
                            @error('email')
                                {{$message}}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Update</button>
                        <button type="reset" class="btn btn-sm btn-warning">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>   
@endsection