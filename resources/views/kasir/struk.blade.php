@extends('layout.app')

@section('judul', 'Struk')
@section('konten')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Struk Pembelian</h4>
                    <p>Toko Baju Laravel</p>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <p>No. Transaksi: {{ $transaksi->kode_transaksi }}</p>
                        <p>Tanggal: {{ $transaksi->tanggal->format('d/m/Y H:i') }}</p>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->items as $item)
                            <tr>
                                <td>{{ $item->baju->merek_baju }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Total</th>
                                <th>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th colspan="3">Jumlah Bayar</th>
                                <th>Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th colspan="3">Kembalian</th>
                                <th>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="text-center mt-4">
                        <p>Terima kasih telah berbelanja</p>
                        <button onclick="window.print()" class="btn btn-primary">Cetak Struk</button>
                        <a href="{{ route('kasir.index') }}" class="btn btn-success">Transaksi Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection