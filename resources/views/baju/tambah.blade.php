@extends('layout.app')

@section('judul', 'Tambah Baju')
@section('konten')

<div class="container">
    <h1>Tambah Data Baju</h1>
    <form action="{{ route('baju.submit') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="">Foto Baju</label>
        <input type="file" class="form-control mb-2" name="gambar" accept="image/*">
        <img id="preview-gambar" src="#" alt="Preview Gambar" class="img-thumbnail mt-2" style="display:none; max-width: 200px;">
        <label for="">Merek Baju</label>
        <input type="text" name="merek_baju" class="form-control mb-2">
        <label for="">Ukuran</label>
        <select class="form-select" name="ukuran">
            <option selected>Pilih</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XLL">XXL</option>
        </select>
        <label for="">Bahan Baju</label>
        <select class="form-select" name="bahan_baju">
            <option selected>Pilih</option>
            <option value="Katun(Cotton)">Katun(Cotton)</option>
            <option value="Linen">Linen</option>
            <option value="Polyster">Polyster</option>
            <option value="Rayon(Viscose)">Rayon(Viscose)</option>
            <option value="Spandeks">Spandeks</option>
            <option value="Wol">Wol</option>
            <option value="Sutra">Sutra</option>
        </select>
        <label for="">Harga Baju</label>
        <input type="text" name="harga_baju" class="form-control mb-2">

        <button class="btn btn-primary">Tambah Data</button>
    </form>
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