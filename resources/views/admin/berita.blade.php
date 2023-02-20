@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Berita</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Berita
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
                <button type="button" class="btn shadow btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="bi bi-plus"></i>
                    Posting Berita
                </button>

                <!-- Modal Add Data -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Posting Berita</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ Route('admin.tambah_berita') }}" enctype="multipart/form-data" method="POST"
                                autocomplete="off">
                                @csrf
                                <div class="modal-body">

                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label>Berita</label>
                                            <input type="text" class="form-control" name="isi"
                                                placeholder="Isi Berita" required />
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Post Berita</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Add Data -->

                {{-- Modal Edit  --}}
                @foreach ($beritas as $berita)
                    <div class="modal fade" id="update-berita{{ $berita->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.update_berita', $berita->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="formGroupExampleInput" class="form-label">Berita</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput"
                                                placeholder="" name="isi" value="{{ $berita->isi }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- End Modal Edit --}}


                {{-- Modal Delete --}}
                @foreach ($beritas as $berita)
                    <div class="modal fade modal-borderless" id="hapus-berita{{ $berita->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action={{ url('/admin/hapus/berita/' . $berita->id) }} method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <center class="mt-3">
                                            <p>
                                                apakah anda yakin ingin menghapus data ini?
                                            </p>

                                        </center>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-danger">Hapus!</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- End Modal Delete --}}



                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Berita</th>
                            <th>Ubah Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beritas as $berita)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $berita->isi }}</td>
                                <td class="align-middle">
                                    @if ($berita->status == 'nonaktif')
                                    <form action="{{ route('admin.update_status_berita', $berita->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        <input type="hidden" value="{{ $berita->status }}" name="status">
                                        <button type="submit"
                                            class="btn shadow btn-outline-danger">
                                            {{ $berita->status }}
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.update_status_berita', $berita->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        <input type="hidden" value="{{ $berita->status }}" name="status">
                                        <button type="submit"
                                            class="btn shadow btn-outline-success">
                                            {{ $berita->status }}
                                        </button>
                                    </form>
                                    @endif
                                    
                                </td>

                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#update-berita{{ $berita->id }}"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus-berita{{ $berita->id }}"><i
                                            class="bi bi-trash3"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
