@extends('layouts.master')

@section('content')
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Formulir Pengembalian Buku</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Formulir Pengembalian Buku
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="card">
            <div class="card-body">
                <form class="form-group" method="POST" action="{{ Route('user.submit_pengembalian') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Judul Buku</label>
                        <select class="form-select" name="buku_id" required>
                            <option value="" disabled selected>-- PILIH BUKU --</option>
                            @foreach ($judul as $b)
                                <option value="{{ $b->buku->id }}">
                                    {{ $b->buku->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Pengembalian</label>
                        <input type="date" class="form-control" name="tgl_pengembalian" value="{{ date('Y-m-d') }}"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label>Kondisi Buku</label>
                        <select class="form-select" name="kondisi_buku_saat_dikembalikan" id="">
                            <option value="" disabled selected>-- PILIH OPSI --</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak (20.000)</option>
                            <option value="hilang">Hilang (50.000)</option>
                        </select>
                    </div>
                    <div class="footer d-flex justify-content-end">
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        <button class="btn btn-primary" type="submit">Kembalikan</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
