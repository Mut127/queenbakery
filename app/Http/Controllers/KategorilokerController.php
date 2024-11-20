<?php

namespace App\Http\Controllers;

use App\Models\Kategoriloker;
use App\Models\Ketegoriloker;
use Illuminate\Http\Request;

class KategorilokerController extends Controller
{
    public function index()
    {
        $kategorilokers = Kategoriloker::all();
        return view('admin.kategoriloker', compact('kategorilokers'));
    }

    public function storeKategoriLoker(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Kategoriloker::create($request->all());

        return redirect()->route('admin.kategoriloker')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function updateKategoriLoker(Request $request, Kategoriloker $ketegoriloker)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $ketegoriloker->update($request->all());

        return redirect()->route('admin.kategoriloker')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyKategoriLoker(Kategoriloker $ketegoriloker)
    {
        $ketegoriloker->delete();

        return redirect()->route('admin.kategoriloker')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
