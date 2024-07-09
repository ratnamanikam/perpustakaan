<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all bukus
        $kategori = Kategori::latest()->paginate(5);

        //return collection of bukus as a resource
        return new UserResource(true, 'List Data Kategori', $kategori);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_kategori'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create buku
        $kategori = Kategori::create([
            'nama_kategori'   => $request->nama_kategori,
        ]);

        //return response
        return new UserResource(true, 'Data Kategori Berhasil Ditambahkan!', $kategori);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //find buku by ID
        $kategori = Kategori::find($id);

        //return single post as a resource
        return new UserResource(true, 'Detail Data kategori!', $kategori);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_kategori'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find buku by ID
        $kategori = Kategori::find($id);

        $kategori->update([
            'nama_kategori'   => $request->nama_kategori,
        ]);
        

        //return response
        return new UserResource(true, 'Data Kategori Berhasil Diubah!', $kategori);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //find post by ID
        $kategori = Kategori::find($id);

        //delete post
        $kategori->delete();

        //return response
        return new UserResource(true, 'Data Kategori Berhasil Dihapus!', null);
    }
}
