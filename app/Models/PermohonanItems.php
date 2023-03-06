<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanItems extends Model
{
    use HasFactory;

    protected $table = 'permohonan_items';
    protected $guard = ['id'];

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
