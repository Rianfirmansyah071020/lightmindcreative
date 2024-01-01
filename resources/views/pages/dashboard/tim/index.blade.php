@extends('layouts.main_dashboard')

@section('title')
    Tim
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tim') }}">Tim</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="">
            <a href="{{ route('tim.create') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-plus"></i>
                Tambah</a>
        </div>
    </div>
    <p>Halaman Kelola Data Tim</p>
    <div class="row card p-3 mt-2 table-responsive">
        <h5 class="text-center">Data Tim</h5>
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Aktor</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Nomor HP</th>
                    <th class="text-center">Status Tim</th>
                    <th class="text-center">Bidang</th>
                    <th class="text-center">Deskripsi Bidang</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Level Akun</th>
                    <th class="text-center">Status Akun</th>
                    <th class="text-center">___Opsi___</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tim as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $data['aktor'] }}</td>
                        <td class="text-center">{{ $data['nama_tim'] }}</td>
                        <td class="text-center">{{ $data['jenis_kelamin_tim'] }}</td>
                        <td class="text-center">{{ $data['alamat_tim'] }}</td>
                        <td class="text-center">{{ $data['nomor_hp_tim'] }}</td>
                        <td class="text-center">
                            @if ($data['status_tim'] == 1)
                                <span class="badge badge-success">
                                    Aktif
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Tidak
                                </span>
                            @endif
                        </td>
                        <td class="text-center">{{ $data['nama_bidang_tim'] }}</td>
                        <td class="text-center">{{ $data['deskripsi_bidang_tim'] }}</td>
                        <td class="text-center">{{ $data['email'] }}</td>
                        <td class="text-center">
                            @if ($data['level_user'] == 1)
                                <span class="badge badge-info">
                                    Admin
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    -
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($data['status_user'] == 1)
                                <span class="badge badge-success">
                                    Aktif
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Tidak
                                </span>
                            @endif
                        </td>
                        <td class="text-center d-flex justify-content-between gap-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalShow{{ $data['id_tim'] }}">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalShow{{ $data['id_tim'] }}" tabindex="-1"
                                aria-labelledby="modalShowLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h1 class="modal-title fs-5" id="modalShowLabel">Detail Data
                                                {{ $data['nama_tim'] }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row d-flex justify-content-between">
                                                <div class="col-lg-6">
                                                    <img src="{{ $data['file_gambar_tim'] }}"
                                                        alt="{{ $data['nama_tim'] }}" style="all: initial; width:200px;">
                                                </div>
                                                <div class="col-lg-6">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td class="text-start">Nama</td>
                                                            <td class="text-start"> {{ $data['nama_tim'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start">Jenis Kelamin</td>
                                                            <td class="text-start"> {{ $data['jenis_kelamin_tim'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start">Alamat</td>
                                                            <td class="text-start"> {{ $data['alamat_tim'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start">Bidang</td>
                                                            <td class="text-start"> {{ $data['nama_bidang_tim'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start">Deskripsi Bidang</td>
                                                            <td class="text-start"> {{ $data['deskripsi_bidang_tim'] }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start">Email</td>
                                                            <td class="text-start"> {{ $data['email'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start">Level Akun</td>
                                                            <td class="text-start"> {{ $data['level_user'] }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success"
                                                data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('tim.edit', [$data['id_tim'], $data['id_user']]) }}"
                                class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('tim.delete', [$data['id_tim'], $data['id_user']]) }}"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
