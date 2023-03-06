<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';
    protected $guard = ['id'];

    public function permohonan_items()
    {
        return $this->hasMany(PermohonanItems::class);
    }
}
