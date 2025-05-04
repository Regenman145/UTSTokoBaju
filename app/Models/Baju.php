<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Baju extends Model
{
    use HasFactory;
    protected $table = 'baju';
    protected $fillable = ['gambar', 'merek_baju', 'ukuran', 'bahan_baju', 'harga_baju'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($baju) {
            $lastId = DB::table('baju')->max('id') + 1;
            $baju->kode_barang = 'BAJU' . str_pad($lastId, 3, '0', STR_PAD_LEFT);
        });
    }
}
