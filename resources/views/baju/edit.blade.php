@extends('layout.app')

@section('judul', 'Tambah Baju')
@section('konten')

<div class="container">
    <h1>Edit Data Baju</h1>
    <form action="{{ route('baju.update', $baju->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="">Foto Baju</label>
        <input type="file" name="gambar" class="form-control mb-2" accept="image/*">
        @error('gambar')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        @if($baju->gambar)
        <img src="{{ asset('uploads/' . $baju->gambar) }}" alt="Foto Lama" class="img-thumbnail mt-2" style="max-width: 200px;">
        @endif
        <br>
        <label for="">Kode Barang</label>
        <input type="text" name="kode_barang" class="form-control mb-2" value="{{ old('kode_barang', $baju->kode_barang) }}" readonly>
        @error('kode_barang')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="">Merek Baju</label>
        <input type="text" name="merek_baju" class="form-control mb-2" value="{{ old('merek_baju', $baju->merek_baju) }}">
        @error('merek_baju')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="">Ukuran</label>
        <select class="form-select" name="ukuran" value="{{ old('ukuran', $baju->ukuran) }}">
            <option selected>Pilih</option>
            <option value="S" @selected(old('ukuran', $baju->ukuran) == 'S')>S</option>
            <option value="M" @selected(old('ukuran', $baju->ukuran) == 'M')>M</option>
            <option value="L" @selected(old('ukuran', $baju->ukuran) == 'L')>L</option>
            <option value="XL" @selected(old('ukuran', $baju->ukuran) == 'XL')>XL</option>
            <option value="XLL" @selected(old('ukuran', $baju->ukuran) == 'XXL')>XXL</option>
        </select>
        @error('ukuran')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="">Bahan Baju</label>
        <select class="form-select" name="bahan_baju">
            <option disabled selected>Pilih bahan baju</option>
            <option value="Katun(Cotton)" @selected(old('bahan_baju', $baju->bahan_baju) == 'Katun(Cotton)')>Katun (Cotton)</option>
            <option value="Linen" @selected(old('bahan_baju', $baju->bahan_baju) == 'Linen')>Linen</option>
            <option value="Polyster" @selected(old('bahan_baju', $baju->bahan_baju) == 'Polyster')>Polyster</option>
            <option value="Rayon(Viscose)" @selected(old('bahan_baju', $baju->bahan_baju) == 'Rayon(Viscose)')>Rayon (Viscose)</option>
            <option value="Spandeks" @selected(old('bahan_baju', $baju->bahan_baju) == 'Spandeks')>Spandeks</option>
            <option value="Wol" @selected(old('bahan_baju', $baju->bahan_baju) == 'Wol')>Wol</option>
            <option value="Sutra" @selected(old('bahan_baju', $baju->bahan_baju) == 'Sutra')>Sutra</option>
        </select>
        @error('bahan_baju')
        <div class="text-danger">{{ $message }}</div>
        @enderror


        <label for="">Harga Baju</label>
        <input type="text" name="harga_baju" class="form-control mb-2" value="{{ old('harga_baju', $baju->harga_baju) }}">
        @error('harga_baju')
        <div class="text-danger">{{ $message }}</div>
        @enderror


        <button class="btn btn-success mt-3">Update Data</button>
</div>
@push('scripts')
<script>
    document.querySelector("input[name='gambar']").addEventListener('change', function(e) {
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById("preview-gambar");
            preview.src = URL.createObjectURL(file);
            preview.style.display = "block";
        }
    });
</script>
@endpush
@endsection