<?php

namespace App\Http\Controllers;

use App\Models\Baju;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Kasir extends Controller
{
    public function index()
    {
        $baju = Baju::all();
        return view('kasir.index', compact('baju'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.baju_id' => 'required|exists:baju,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'jumlah_bayar' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();

        try {
            // Hitung total harga
            $total = 0;
            $items = [];

            foreach ($request->items as $item) {
                $baju = Baju::find($item['baju_id']);
                $subtotal = $baju->harga_baju * $item['quantity'];

                $items[] = [
                    'baju_id' => $baju->id,
                    'quantity' => $item['quantity'],
                    'harga_satuan' => $baju->harga_baju,
                    'subtotal' => $subtotal
                ];

                $total += $subtotal;
            }

            // Cek uang pembayaran
            if ($request->jumlah_bayar < $total) {
                return back()->with('error', 'Jumlah bayar kurang dari total harga');
            }

            // Buat transaksi
            $transaksi = Transaksi::create([
                'total_harga' => $total,
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian' => $request->jumlah_bayar - $total,
                'tanggal' => now()
            ]);

            // Tambahkan items transaksi
            foreach ($items as $item) {
                $item['transaksi_id'] = $transaksi->id;
                TransaksiItem::create($item);
            }
            DB::commit();
            return redirect()->route('kasir.struk', $transaksi->id)->with('success', 'Transaksi berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Transaksi gagal: ' . $e->getMessage());
        }
    }

    public function struk($id)
    {
        $transaksi = Transaksi::with('items.baju')->findOrFail($id);
        return view('kasir.struk', compact('transaksi'));
    }

    public function history()
    {
        $transaksi = Transaksi::with('items.baju')->orderBy('created_at', 'desc')->get();
        return view('kasir.history', compact('transaksi'));
    }
}
