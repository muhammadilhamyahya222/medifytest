<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Kategori::query();

        if($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        if($request->filled('kode')) {
            $query->where('kode', 'like', '%' . $request->nama . '%');
        }

        $kategoris = $query->latest()->paginate(10);

        return view('kategoris.index', compact('kategoris'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|string|unique:kategoris,kode|max:255',
            'nama' => 'required|string|max:255',
        ]);

        Kategori::create($validatedData);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        $kategori->load('masterItems');

        return view('kategoris.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('kategoris.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validatedData = $request->validate([
            'kode' => 'required|string|unique:kategoris,kode,' . $kategori->id . '|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $kategori->update($validatedData);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        if($kategori->masterItems()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus');
        }

        $kategori->delete();

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus');
    }
}
