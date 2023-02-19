@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pesan Masuk</h3>
                    <p class="text-subtitle text-muted">Pesan Dari Admin</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Pesan Masuk
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
                            <th>Pengirim</th>
                            <th>Judul Pesan</th>
                            <th>Isi Pesan</th>
                            <th>Status Pesan</th>
                            <th>Tanggal Kirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($masuk as $key => $p)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $p->pengirim->fullname }}</td>
                                <td>{{ $p->judul }}</td>
                                <td>{{ $p->isi }}</td>
                                <td>{{ $p->status == 'terkirim' ? 'Belum Dibaca' : 'Terbaca' }}</td>
                                <td>{{ $p->tgl_kirim }}</td>
                                <td>
                                    @if ($p->status == 'terkirim')
                                        <form action="{{ route('user.ubah_status', ['id' => $p->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="penerima_id" value="{{ Auth::user()->id }}">
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-primary"><i class="bi bi-check2-all"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
