@extends('layout.main')
@section('title', 'kategori.create')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Data</h1>

    <div class="row">
        <div class="col-6">            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('buku.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Gambar</label>
                            <div class="custom-file">
                                <input type="file" name="gambar" class="custom-file-input" id="gambar">
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
                            <input type="text" name="judul" class="form-control">
                            @error('judul')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" name="penulis" class="form-control">
                            @error('penulis')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>isbn</label>
                            <input type="text" name="isbn" class="form-control">
                            @error('isbn')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="text" name="tahun_terbit" class="form-control">
                            @error('tahun_terbit')
                                {{$message}}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select type="text" name="id_kategori" class="form-control">
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
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-sm btn-warning"> Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>   
@endsection