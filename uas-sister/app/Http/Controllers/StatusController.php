<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = Status::paginate(10);
        //$status = Status::all();
        return view('status.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = Status::all();
        return view('status.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi=$request->validate([
            'nama_status'=> 'required|string|max:255',
        ]);
        try {
            $response = Status::create($validasi);
            return redirect()->route('status.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $status = Status::findOrFail($id);

        //render view with post
        return view('status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_status'=> 'required|string|max:255',
        ]);
        try {
            // Ambil data buku berdasarkan ID
            $status = Status::findOrFail($id);

            // Update the book record
            $status->update($validasi);
            return redirect()->route('status.index')->with('success', 'Data berhasil diubah!');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Status::findOrFail($id);

        // Delete the book record
        $status->delete();
        return redirect()->route('status.index')->with(['success' => 'Data berhasil dihapus.']);
    }
}
