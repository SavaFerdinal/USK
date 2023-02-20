@extends('layouts.master')

@section('content')
<div class="page-heading mb-4">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Dahboard</h3>

      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav
          aria-label="breadcrumb"
          class="breadcrumb-header float-start float-lg-end"
        >
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            {{-- <li class="breadcrumb-item active" aria-current="page">
              Layout Vertical Navbar
            </li> --}}
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>  

<div class="mb-10">
  @foreach ($beritas as $berita)
      <div class="alert alert-primary alert-dismissible fade show">
          {{ $berita->isi }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endforeach
</div>

<div class="section">
  <div class="row">
    @foreach ($bukus as $buku)
        <div class="col-xl-4 col-md-6 col-sm-12">
          <div class="card">
            <div class="card-content">
              <img
                src="{{ $buku->foto ?? '/assets/images/not-found.png' }}"
                class="card-img-top img-fluid"
                alt="{{ $buku->judul }}"
              />
              <div class="card-body">
                <h5 class="card-title">{{ $buku->judul }}</h5>
                <p class="card-text">
                  <span class="badge bg-light-primary">{{ $buku->kategori->nama }}</span>
                  <div class="row">
                      <div class="col-6">
                          <p class="text-start">{{ $buku->pengarang }}</p>
                      </div>
                      <div class="col-6">
                          <p class="text-end">{{ $buku->penerbit->nama }}</p>
                      </div>
                  </div>
                </p>
              </div>
              <div class="card-footer d-flex justify-content-end">
                <form method="POST" action="{{ route('user.form_peminjaman_dashboard') }}">
                  @csrf
                  <input type="hidden" value="{{ $buku->id }}" name="buku_id">
                  <button type="submit" class="btn btn-primary">Pinjam</button>
              </form>
              </div>
            </div>
          </div>
        </div>
        @endforeach
  </div>
</div>
@endsection
