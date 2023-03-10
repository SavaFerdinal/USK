@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Profile</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Profile
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-3">
                <center>
                    <img src="{{ Auth::user()->foto == null ? 'profile.png' : Auth::user()->foto }}" class="rounded-circle"
                        style="width: 150px;" alt="Avatar" />
                </center>
            </div>
            
            <form action="{{ Route('user.gambar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Update Profile</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table bordered">
                            <tr>
                                <th>Foto</th>
                                <td>
                                    <input type="file" class="form-control" name="foto">
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>
                                    <input class="form-control" type="text" name="fullname"
                                        value="{{ Auth::user()->fullname }}">
                                </td>
                            </tr>

                            <tr>
                                <th>Username</th>
                                <td>
                                    <input class="form-control" type="text" name="username"
                                        value="{{ Auth::user()->username }}">
                                </td>
                            </tr>

                            <tr>
                                <th>NIS</th>
                                <td>
                                    <input class="form-control" type="text" name="nis"
                                        value="{{ Auth::user()->nis }}">
                                </td>
                            </tr>

                            <tr>
                                <th>Alamat</th>
                                <td>
                                    <textarea name="alamat" class="form-control">{{ Auth::user()->alamat }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>
                                    <input class="form-control" type="password" name="password"
                                        placeholder="Sandi belum dirubah" autocomplete="" required>
                                </td>
                            </tr>

                            <tr>
                                <th>Kelas</th>
                                <td>
                                    <input class="form-control" type="text" name="kelas"
                                        value="{{ Auth::user()->kelas }}">
                                </td>
                            </tr>

                        </table>

                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-primary">
                            Update Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
