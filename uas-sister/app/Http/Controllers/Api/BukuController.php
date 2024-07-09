<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all bukus
        $bukus = Buku::latest()->paginate(5);

        //return collection of bukus as a resource
        return new UserResource(true, 'List Data Buku', $bukus);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'gambar'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul'         => 'required',
            'penulis'       => 'required',
            'isbn'          => 'required',
            'tahun_terbit'  => 'required',
            'id_kategori'   => '',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            //upload image
            $fileName = time() . $request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('gambar', $fileName, 'public');
            
            //create buku
            $buku = Buku::create([
                'gambar'        => $path,
                'judul'         => $request->judul,
                'penulis'       => $request->penulis,
                'isbn'          => $request->isbn,
                'tahun_terbit'  => $request->tahun_terbit,
                'id_kategori'   => $request->id_kategori,
            ]);

            //return response
            return new UserResource(true, 'Data Buku Berhasil Ditambahkan!', $buku);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find buku by ID
        $buku = Buku::find($id);

        //return single post as a resource
        return new UserResource(true, 'Detail Data Buku!', $buku);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'         => 'required',
            'penulis'       => 'required',
            'isbn'          => 'required',
            'tahun_terbit'  => 'required',
            'id_kategori'   => '',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find buku by ID
        $buku = Buku::find($id);

        //check if image is not empty
        if ($request->hasFile('gambar')) {

            //upload image
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/gambar', $gambar->hashName());

            //delete old image
            Storage::delete('public/gambar/' . basename($buku->gambar));

            //update post with new image
            $buku->update([
                'gambar'        => $gambar->hashName(),
                'judul'         => $request->judul,
                'penulis'       => $request->penulis,
                'isbn'          => $request->isbn,
                'tahun_terbit'  => $request->tahun_terbit,
                'id_kategori'   => $request->id_kategori,
            ]);
        } else {

            //update post without image
            $buku->update([
                'judul'         => $request->judul,
                'penulis'       => $request->penulis,
                'isbn'          => $request->isbn,
                'tahun_terbit'  => $request->tahun_terbit,
                'id_kategori'   => $request->id_kategori,
            ]);
        }

        //return response
        return new UserResource(true, 'Data Buku Berhasil Diubah!', $buku);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {

        //find post by ID
        $buku = Buku::find($id);

        //delete image
        Storage::delete('public/gambar/'.basename($buku->gambar));

        //delete post
        $buku->delete();

        //return response
        return new UserResource(true, 'Data Buku Berhasil Dihapus!', null);
    }
}
