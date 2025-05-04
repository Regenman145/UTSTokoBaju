@extends('layout.app')

@section('judul', 'Data Input Baju')
@section('konten')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Barang Page</h1>
</div>
<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data input Baju</h5>
            <a href="{{ route('baju.tambah') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Tambah Data Baju
            </a>
        </div>
        <div class="card-body">
            <table class="table" id="tabel-baju">
                <thead class="table-success">
                    <tr>
                        <th>Kode barang</th>
                        <th>Gambar</th>
                        <th>Merek Baju</th>
                        <th>Ukuran</th>
                        <th>Bahan Baju</th>
                        <th>Harga Baju</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataBaju as $baju)
                    <tr>
                        <td>{{ $baju->kode_barang }}</td>
                        <td>
                            @if ($baju->gambar)
                            <img src="{{ asset('uploads/' . $baju->gambar) }}" alt="Gambar" width="60">
                            @else
                            -
                            @endif
                        </td>
                        <td>{{ $baju->merek_baju}}</td>
                        <td>{{ $baju->ukuran }}</td>
                        <td>{{ $baju->bahan_baju }}</td>
                        <td>Rp {{ number_format($baju->harga_baju, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('baju.edit', $baju->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('baju.hapus', $baju->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection