@extends('layouts.master')

@section('content')
    <div class="page-heading mb-4">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Riwayat Peminjaman Buku</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Riwayat Peminjaman Buku
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if (session('status'))
        <div class="alert alert-{{ session('status') }} alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="secton">
      <div class="card">
        <div class="card-body">
          <table class="table table-striped" id="table1">
            <thead>
              <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Kondisi Buku</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($peminjamans as $key => $peminjaman)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $peminjaman->buku->judul }}</td>
                <td>{{ $peminjaman->tgl_peminjaman }}</td>
                <td>{{ $peminjaman->tgl_pengembalian }}</td>
                <td>{{ $peminjaman->kondisi_buku_saat_dipinjam }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection
