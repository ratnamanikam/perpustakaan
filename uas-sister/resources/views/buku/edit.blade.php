@extends('layout.main')
@section('title', 'buku.edit')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Edit User</h1>

    <div class="row">
        <div class="col-6">            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Data</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('buku.update', $buku->id_buku)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Gambar</label>
                            <div class="custom-file">
                                <input type="file" name="gambar" class="custom-file-input" id="gambar" accept="image/jpeg, image/png, image/jpg">
                                <label class="custom-file-label" for="gambar">Pilih file</label>
                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul', $buku->judul) }}">
                            @error('judul')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $buku->penulis) }}">
                            @error('penulis')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $buku->isbn) }}">
                            @error('isbn')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="text" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                            @error('tahun_terbit')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select type="text" name="id_kategori" class="form-control" value="{{ old('id_kategori', $buku->id_kategori) }}">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option {{((isset($buku)&&$buku->id_kategori==$item->id_kategori) || old('id_kategori')==$item->id_kategori)?'selected':''}}
                                value="{{$item->id_kategori}}"> {{$item->nama_kategori}}</option>
                            @endforeach
                            </select>
                            @error('id_kategori')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
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