@extends('layout.app')

@section('judul', 'Tentang')
@section('konten')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body text-center">
            <img src="{{ asset('/img/About.jpg') }}" class="img-fluid rounded-circle mb-4" style="width: 200px; height: 200px; object-fit: cover;" alt="Foto Profil">

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <h3 class="font-weight-bold">Halo, Saya Dafa Ahmad Sajangah</h3>
                    <div class="text-left mt-4">
                        <div class="mb-4">
                            <h4 class="font-weight-bold text-primary">Informasi Pribadi</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-birthday-cake mr-2"></i> <strong>Tanggal Lahir:</strong> [20/05/2003]</li>
                                <li class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i> <strong>Alamat:</strong> Jl Achmad Nur Kauman Purbalingga lor, Purbalingga, Jawa Tengah, Indonesia</li>
                                <li class="mb-2"><i class="fas fa-envelope mr-2"></i> <strong>Email:</strong> <a href="mailto:email@contoh.com">dafaahmad145@gmail.com</a></li>
                                <li class="mb-2"><i class="fas fa-phone mr-2"></i> <strong>Telepon:</strong> [+62 895 3589 88740]</li>
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-weight-bold text-primary">Pendidikan</h4>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <h5>STMIK WIDYA UTAMA</h5>
                                    <p class="text-muted">Teknik Informatika</p>
                                    <p>NIM : STI202202731</p>
                                </div>
                            </div>
                        </div>
                        <div class="social-links mt-4">
                            <a href="https://www.instagram.com/dafa_ahmadsa145/profilecard/?igsh=MWw0OHBuZXhjbDVuNA==" class="btn btn-outline-danger mr-2"><i class="fab fa-instagram"></i></a>
                            <a href="https://github.com/Regenman145?tab=repositories" class="btn btn-outline-dark mr-2"><i class="fab fa-github"></i></a>
                            <a href="https://www.linkedin.com/in/dafa-ahmad-sajangah-0a4a46193/" class="btn btn-outline-primary mr-2"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection