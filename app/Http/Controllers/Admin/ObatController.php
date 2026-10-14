<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::latest()->get();

        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|integer|min:0',
        ]);

        Obat::create($data);

        return redirect()->route('obat.index')
            ->with('message', 'Data obat berhasil ditambahkan')
            ->with('type', 'success');
    }

    public function edit(Obat $obat)
    {
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $data = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:35',
            'harga' => 'required|integer|min:0',
        ]);

        $obat->update($data);

        return redirect()->route('obat.index')
            ->with('message', 'Data obat berhasil diperbarui')
            ->with('type', 'success');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('obat.index')
            ->with('message', 'Data obat berhasil dihapus')
            ->with('type', 'success');
    }
}