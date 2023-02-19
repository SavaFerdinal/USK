@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Peminjaman</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Peminjaman
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

    <div class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>tgl Peminjaman</th>
                            <th>tgl Pengembalian</th>
                            <th>Kondisi Dipinjam</th>
                            <th>Kondisi Dikembalikan</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->user->username }}</td>
                                <td>{{ $p->buku->judul }}</td>
                                <td>{{ $p->tgl_peminjaman }}</td>
                                <td>{{ $p->tgl_pengembalian }}</td>
                                <td>{{ $p->kondisi_buku_saat_dipinjam }}</td>
                                <td>{{ $p->kondisi_buku_saat_dikembalikan }}</td>
                                <td>IDR. {{ $p->denda }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
