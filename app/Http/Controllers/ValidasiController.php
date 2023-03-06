<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use App\Models\PermohonanItems;

class ValidasiController extends Controller
{
    public function index()
    {
        $permohonan = Permohonan::where('status', '!=', 'draft')
                                // ->Where('status', '!=', 'done')
                                ->get();

        foreach ($permohonan as $data) :
            $data['color_status'] = $this->color_status($data->status);
        endforeach;

        $data = [
            'permohonan' => $permohonan,
        ];

        return view('dashboard.validasi.index', $data);
    }

    public function approve($permohonan_id)
    {
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan->status = 'approve';
        $permohonan->save();

        return redirect()->route('validasi.index');
    }

    public function reject($permohonan_id)
    {
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan->status = 'reject';
        $permohonan->save();

        return redirect()->route('validasi.index');
    }

    public function detail_permohonan($permohonan_id)
    {
        $permohonan = Permohonan::find($permohonan_id);
        $permohonan_items = PermohonanItems::where('permohonan_id', $permohonan_id)->get();

        $data = [
            'permohonan' => $permohonan,
            'permohonan_items' => $permohonan_items,
        ];

        return view('dashboard.validasi.detail', $data);
    }
}
