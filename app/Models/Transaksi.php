<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'kode_transaksi',
        'total_harga',
        'jumlah_bayar',
        'kembalian',
        'tanggal'
    ];
    protected $casts = [
        'tanggal' => 'datetime',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            $transaksi->kode_transaksi = 'TRX' . date('Ymd') . str_pad(Transaksi::count() + 1, 3, '0', STR_PAD_LEFT);
        });
    }
    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
}
