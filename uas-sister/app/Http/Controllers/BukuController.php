<?php

namespace App\Http\Controllers;

use App\Models\Buku;
Use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::paginate(10);
        $buku = new Buku;
        if (isset($_GET['s'])) {
            $s=$_GET['s'];
            $buku = $buku->where('judul', 'like', "%$s%");
        }
        if (isset($_GET['id_kategori'])&&$_GET['id_kategori']!='') {

            $buku = $buku->where('id_kategori', 'like', $_GET['id_kategori']);
        }

        $buku = $buku->paginate(10);
        $kategori = Kategori::all();
        return view('buku.index', compact('buku', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate form
        $validasi=$request->validate([
            'gambar'=> 'required|file|mimes:jpg,png,jpeg|max:2048',
            'judul'=> 'required|string|max:255',
            'penulis'=> 'required|string|max:255',
            'isbn'=> 'required|string',
            'tahun_terbit'=> 'required|digits:4',
            'id_kategori'=> 'required',
        ]);
        try {
            $fileName = time() . $request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('gambar',$fileName, 'public');
            $validasi['gambar'] = $path;
            $response = Buku::create($validasi);
            return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        /*//create post
        Datatunggal::create([
            'skor'=> $request->skor,
        ]);

        //redirect to index
        return redirect()->route('datatunggals.index')->with(['success' => 'Data Berhasil Disimpan!']);*/
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
        //get post by ID
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();

        //render view with post
        return view('buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'gambar'=> 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            'judul'=> 'required|string|max:255',
            'penulis'=> 'required|string|max:255',
            'isbn'=> 'required|string',
            'tahun_terbit'=> 'required|digits:4',
            'id_kategori'=> 'required',
        ]);
        try {
            // Ambil data buku berdasarkan ID
            $buku = Buku::findOrFail($id);
            // Check if there's a new image uploaded
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($buku->gambar) {
                    Storage::delete('public/' . $buku->gambar); // Sesuaikan dengan path penyimpanan Anda
                }
                // Upload and store the new image
                $fileName = time() . $request->file('gambar')->getClientOriginalName();
                $path = $request->file('gambar')->storeAs('gambar',$fileName, 'public');
                $validasi['gambar'] = $path;
            }

            // Update the book record
            $buku->update($validasi);

            return redirect()->route('buku.index')->with('success', 'Data berhasil diubah!');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);

        // Delete the image file associated with the book if it exists
        if ($buku->gambar) {
            Storage::delete('public/' . $buku->gambar); // Sesuaikan dengan path penyimpanan Anda
        }

        // Delete the book record
        $buku->delete();

        return redirect()->route('buku.index')->with(['success' => 'Data berhasil dihapus.']);
    }
}
