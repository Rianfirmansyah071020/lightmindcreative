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
                        <td class="text-center">
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
