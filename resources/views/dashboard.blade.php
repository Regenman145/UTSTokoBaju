@extends('layout.app')

@section('judul', 'Dashboard')
@section('konten')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard Page</h1>

</div>
<div class="container-fluid">
    <!-- @if(Auth::check())
    <b>Halo {{ Auth::user()->name }}, Anda Berhasil Login </b>
    @endif -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            @if(Auth::check())
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Anda Berhasil Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Halo, {{ Auth::user()->name }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection