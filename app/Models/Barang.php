<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $guard = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function permohonan_items()
    {
        return $this->hasMany(PermohonanItems::class);
    }
}
