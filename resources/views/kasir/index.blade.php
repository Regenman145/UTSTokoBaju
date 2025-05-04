@extends('layout.app')

@section('judul', 'Kasir')
@section('konten')

<div class="container">
    <h2>Kasir Toko Baju</h2>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Daftar Baju</div>
                <div class="card-body">
                    <div class="row">
                        @foreach($baju as $item)
                        <div class="col-md-4 mb-3">
                            <div class="card product-item" data-id="{{ $item->id }}" data-name="{{ $item->merek_baju }}" data-price="{{ $item->harga_baju }}" data-stock="{{ $item->stok }}">
                                <img src="{{ asset('uploads/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->merek_baju }}" style="height: 150px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->merek_baju }}</h5>
                                    <p class="card-text">
                                        Rp {{ number_format($item->harga_baju, 0, ',', '.') }}<br>
                                        Ukuran: {{ $item->ukuran }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Transaksi</div>
                <div class="card-body">
                    <form id="transactionForm" action="{{ route('kasir.store') }}" method="POST">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="transactionItems">
                                <!-- Items akan ditambahkan via JavaScript -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th id="totalAmount">Rp 0</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="3">Jumlah Bayar</th>
                                    <td><input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" required></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th colspan="3">Kembalian</th>
                                    <td id="kembalian">Rp 0</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="form-group mt-3">
                            <label for="jumlah_bayar">Jumlah Bayar</label>
                            <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" required>
                        </div>

                        <div class="form-group">
                            <label for="kembalian">Kembalian</label>
                            <input type="number" class="form-control" id="kembalian" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-3">Proses Transaksi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('kasir.history') }}" class="btn btn-secondary fixed-bottom-right m-3">
    <i class="fas fa-history"></i> Riwayat Transaksi
</a>

@push('scripts')
<script>
    $(document).ready(function() {
        let transactionItems = [];
        let total = 0;

        //fungsi untuk format rupiah
        function formatRupiah(angka) {
            return 'Rp' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Tambahkan item ke transaksi
        $('.product-item').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).data('price');

            // Cek apakah item sudah ada di transaksi
            const existingItem = transactionItems.find(item => item.id === id);

            if (existingItem) {
                existingItem.quantity += 1;
                existingItem.subtotal = existingItem.quantity * existingItem.price;
            } else {
                transactionItems.push({
                    id: id,
                    name: name,
                    price: price,
                    quantity: 1,
                    subtotal: price
                });
            }

            updateTransactionTable();
        });

        // Update tabel transaksi
        function updateTransactionTable() {
            const $tbody = $('#transactionItems');
            $tbody.empty();

            let total = 0;

            transactionItems.forEach((item, index) => {
                total += item.subtotal;

                $tbody.append(`
                <tr>
                    <td>${item.name}</td>
                    <td>
                        <input type="number" name="items[${index}][quantity]" value="${item.quantity}" min="1" class="form-control qty-input" data-index="${index}">
                        <input type="hidden" name="items[${index}][baju_id]" value="${item.id}">
                    </td>
                    <td>Rp ${item.price.toLocaleString()}</td>
                    <td>Rp ${item.subtotal.toLocaleString()}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-item" data-index="${index}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
            });

            $('#totalAmount').text(`Rp ${total.toLocaleString()}`);
            calculateChange();
        }

        // Hapus item dari transaksi
        $(document).on('click', '.remove-item', function() {
            const index = $(this).data('index');
            transactionItems.splice(index, 1);
            updateTransactionTable();
        });

        // Update quantity
        $(document).on('change', '.qty-input', function() {
            const index = $(this).data('index');
            const newQty = parseInt($(this).val());

            if (newQty > 0) {
                transactionItems[index].quantity = newQty;
                transactionItems[index].subtotal = newQty * transactionItems[index].price;
                updateTransactionTable();
            }
        });

        // Hitung kembalian
        $('#jumlah_bayar').on('input', calculateChange);

        function calculateChange() {
            const total = transactionItems.reduce((sum, item) => sum + item.subtotal, 0);
            const payment = parseFloat($('#jumlah_bayar').val()) || 0;
            const change = payment - total;

            $('#kembalian').val(change >= 0 ? change : 0);
        }

        $('#jumlah_bayar').on('input', calculateChange);
    });
</script>
@endpush

@endsection