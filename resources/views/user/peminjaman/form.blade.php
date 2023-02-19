@extends('layouts.master')

@section('content')
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Formulir Peminjaman Buku</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Formulir Peminjaman Buku
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }} alert-dismissible fade show">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form class="form-group" method="POST" action="{{ Route('user.submit_peminjaman') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Nama</label>
                        <input class="form-control" name="user_id" readonly value="{{ Auth::user()->username }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Pilih Buku</label>
                        <select class="form-select" name="buku_id" required>
                            <option value="" disabled selected>-- PILIH BUKU --</option>
                            @foreach ($bukus as $b)
                                <option value="{{ $b->id }}"
                                    {{ isset($buku_id) ? ($buku_id == $b->id ? 'selected' : '') : '' }}>
                                    {{ $b->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Peminjaman</label>
                        <input type="date" class="form-control" name="tgl_peminjaman" readonly
                            value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Kondisi Buku</label>
                        <select class="form-select" name="kondisi_buku_saat_dipinjam" required>
                            <option value="" disabled selected>-- PILIH OPSI --</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="footer d-flex justify-content-end">
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        <button class="btn btn-primary" type="submit">Pinjam buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
