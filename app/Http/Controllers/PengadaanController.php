<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use App\Models\PermohonanItems;

class PengadaanController extends Controller
{
    public function index()
    {
        $permohonan = Permohonan::where('status', 'approve')
                                ->orWhere('status', 'done')
                                ->get();

        foreach ($permohonan as $data) :
            $data['color_status'] = $this->color_status($data->status);
        endforeach;

        $data = [
            'permohonan' => $permohonan,
        ];

        return view('dashboard.pengadaan.index', $data);
    }

    public function detail_permohonan($permohonan_id)
    {
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan_items = PermohonanItems::where('permohonan_id', $permohonan_id)->get();

        $data = [
            'permohonan' => $permohonan,
            'permohonan_items' => $permohonan_items,
        ];

        return view('dashboard.pengadaan.detail', $data);
    }

    public function selesai_permohonan($permohonan_id)
    {
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan->status = 'done';
        $permohonan->save();

        foreach ($permohonan->permohonan_items as $item) {
            $item->barang->stok += $item->jumlah;
            $item->barang->save();
        }

        return redirect()->route('pengadaan.index');
    }
}
