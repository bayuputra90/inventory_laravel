<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\PermohonanItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        $kategori = Kategori::all();

        $data = [
            'barang' => $barang,
            'kategori' => $kategori,
        ];

        return view('dashboard.barang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'barang' => 'required',
            'kategori_id' => 'required',
        ];

        $message = [
            'barang.required' => 'Kolom barang wajib diisi',
            'kategori_id.required' => 'Pilih salah satu kategori',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $kategori = new Barang();
        $kategori->kategori_id = $request->kategori_id;
        $kategori->nama = $request->barang;
        $kategori->save();

        return redirect('barang')->with('message', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        $permohonan_items = PermohonanItems::select('permohonan_items.*')
                                            ->join('permohonan', 'permohonan_items.permohonan_id', '=', 'permohonan.id')
                                            ->where('permohonan.status', 'done')
                                            ->where('permohonan_items.barang_id', $id)
                                            ->get();

        $data = [
            'barang' => $barang,
            'permohonan_items' => $permohonan_items,
        ];

        return view('dashboard.barang.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        $kategori = Kategori::all();

        $data = [
            'barang' => $barang,
            'kategori' => $kategori,
        ];

        return view('dashboard.barang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'barang' => 'required',
            'kategori_id' => 'required',
        ];

        $message = [
            'barang.required' => 'Kolom barang wajib diisi',
            'kategori_id.required' => 'Pilih salah satu kategori',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kategori = Barang::find($id);
        $kategori->kategori_id = $request->kategori_id;
        $kategori->nama = $request->barang;
        $kategori->save();

        return redirect('barang')->with('message', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect('barang')->with('message', 'Barang berhasil dihapus');
    }
}
