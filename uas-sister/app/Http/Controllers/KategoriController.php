<?php

namespace App\Http\Controllers;

Use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::paginate(10);
        //$kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('kategori.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi=$request->validate([
            'nama_kategori'=> 'required|string|max:255',
        ]);
        try {
            $response = Kategori::create($validasi);
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        //render view with post
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_kategori'=> 'required|string|max:255',
        ]);
        try {
            // Ambil data buku berdasarkan ID
            $kategori = Kategori::findOrFail($id);

            // Update the book record
            $kategori->update($validasi);
            return redirect()->route('kategori.index')->with('success', 'Data berhasil diubah!');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        // Delete the book record
        $kategori->delete();
        return redirect()->route('kategori.index')->with(['success' => 'Data berhasil dihapus.']);
    }
}
