<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Permohonan;
use App\Models\PermohonanItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PermohonanController extends Controller
{
    public function index()
    {
        $permohonan = Permohonan::all();

        foreach ($permohonan as $data) :
            $data['color_status'] = $this->color_status($data->status);
        endforeach;

        $data = [
            'permohonan' => $permohonan,
        ];

        return view('dashboard.permohonan.index', $data);
    }

    public function buat_permohonan(Request $request)
    {
        $rules = [
            'judul' => 'required',
            'sumber' => 'required',
        ];

        $message = [
            'judul.required' => 'Kolom judul permohonan wajib diisi',
            'sumber.required' => 'Kolom sumber anggaran wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $message)->validate();

        $permohonan = new Permohonan();
        $permohonan->judul = $request->judul;
        $permohonan->sumber = $request->sumber;
        $permohonan->save();

        return redirect()->route('permohonan.form', $permohonan->id);
    }

    public function form_permohonan($permohonan_id)
    {
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan_items = PermohonanItems::where('permohonan_id', $permohonan_id)->get();

        $data = [
            'permohonan' => $permohonan,
            'permohonan_items' => $permohonan_items,
        ];

        return view('dashboard.permohonan.form', $data);
    }

    public function simpan_permohonan($permohonan_id)
    {
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan->status = 'pending';
        $permohonan->save();

        return redirect()->route('permohonan.index');
    }

    public function detail_permohonan($permohonan_id)
    {
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan_items = PermohonanItems::where('permohonan_id', $permohonan_id)->get();

        $data = [
            'permohonan' => $permohonan,
            'permohonan_items' => $permohonan_items,
        ];

        return view('dashboard.permohonan.detail', $data);
    }

    public function hapus_permohonan($permohonan_id)
    {
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan->delete();

        return redirect('permohonan')->with('message', 'Permohonan berhasil dihapus');
    }

    public function items($permohonan_id)
    {
        $barang = Barang::all();
        $kategori = Kategori::all();

        $data = [
            'barang' => $barang,
            'kategori' => $kategori,
            'permohonan_id' => $permohonan_id,
        ];

        return view('dashboard.permohonan.items', $data);
    }

    public function tambah_item(Request $request, $permohonan_id)
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

        return redirect()->route('permohonan.items', $permohonan_id);
    }

    public function simpan_item(Request $request, $permohonan_id)
    {
        $rules = [
            'barang_id' => 'required',
            'merk' => 'required',
            'jumlah' => 'required',
            'satuan' => 'required',
            'data_dukung' => 'required',
        ];

        $message = [
            'barang_id.required' => 'Pilih salah satu barang',
            'merk.required' => 'Kolom merk wajib diisi',
            'jumlah.required' => 'Kolom jumlah wajib diisi',
            'satuan.required' => 'Kolom satuan wajib diisi',
            'data_dukung.required' => 'Belum upload data dukung',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $data_dukung = $request->file('data_dukung')->store('uploads', 'public');

        $permohonanItem = new PermohonanItems();
        $permohonanItem->barang_id = $request->barang_id;
        $permohonanItem->permohonan_id = $permohonan_id;
        $permohonanItem->jumlah = $request->jumlah;
        $permohonanItem->satuan = $request->satuan;
        $permohonanItem->merk = $request->merk;
        $permohonanItem->data_dukung = $data_dukung;
        $permohonanItem->save();

        return redirect('permohonan/form_permohonan/' . $permohonan_id);
    }

    public function hapus_item($item_id, $permohonan_id)
    {
        $permohonan_item = PermohonanItems::find($item_id);
        Storage::delete($permohonan_item->data_dukung);
        $permohonan_item->delete();

        return redirect('permohonan/form_permohonan/' . $permohonan_id);
    }
}
