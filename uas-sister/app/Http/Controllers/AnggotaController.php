<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = Anggota::latest()->get();
        return view('anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        // Create Anggota
        Anggota::create([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Redirect to index
        return redirect()->route('anggota.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get Anggota by ID
        $anggota = Anggota::findOrFail($id);

        // Render view with Anggota
        return view('anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get Anggota by ID
        $anggota = Anggota::findOrFail($id);

        // Render view with Anggota
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate form
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        // Get Anggota by ID
        $anggota = Anggota::findOrFail($id);

        // Update Anggota
        $anggota->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Redirect to index
        return redirect()->route('anggota.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);

        $anggota->delete();

        return redirect()->route('anggota.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
