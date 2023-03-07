<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $permohonan = Permohonan::orderBy('created_at', 'desc')->limit(4)->get();

        foreach ($permohonan as $data) {
            $data['color_status'] = $this->color_status($data->status);
        }

        return view('dashboard.home', ['permohonan' => $permohonan]);
    }
}
