<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        $data = [
            'kategori' => $kategori,
        ];
        return view('dashboard.kategori.index', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'kategori' => 'required',
        ];

        $message = [
            'kategori.required' => 'Kolom kategori wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $kategori = new Kategori();
        $kategori->nama = $request->kategori;
        $kategori->save();

        return redirect('kategori')->with('message', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);

        $data = [
            'kategori' => $kategori,
        ];

        return view('dashboard.kategori.ubah', $data);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'kategori' => 'required',
        ];

        $message = [
            'kategori.required' => 'Kolom kategori wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $kategori = Kategori::find($id);
        $kategori->nama = $request->kategori;
        $kategori->save();

        return redirect('kategori')->with('message', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect('kategori')->with('message', 'Kategori berhasil dihapus');
    }
}
