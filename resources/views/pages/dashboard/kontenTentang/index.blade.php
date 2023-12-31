@extends('layouts.main_dashboard')

@section('title')
    Konten Tentang
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tentang') }}">Konten Tentang</a></li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row p-3">
        <div class="d-flex justify-content-end">
            <a href="{{ route('tentang.create') }}" class="btn btn-primary btn-custom"><i class="fa-solid fa-plus"></i>
                Tambah</a>
        </div>
    </div>
    <p>Halaman Kelola Data Konten Tentang</p>
    <div class="row card p-3 mt-2 table-responsive">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Aktor</th>
                    <th class="text-center">Judul</th>
                    <th class="text-center">Deskripsi Judul</th>
                    <th class="text-center">Deskripsi Tentang</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">___Opsi___</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tentang as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $data['aktor'] }}</td>
                        <td class="text-center">{{ $data['judul_tentang'] }}</td>
                        <td class="text-center">{{ $data['deskripsi_judul_tentang'] }}</td>
                        <td class="text-center">{{ $data['deskripsi_tentang'] }}</td>
                        <td class="text-center">
                            @if ($data['status_tentang'] == 1)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Tidak</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalShow{{ $data['id_tentang'] }}">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalShow{{ $data['id_tentang'] }}" tabindex="-1"
                                aria-labelledby="modalShowLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row d-flex justify-content-between">
                                                @foreach ($gambarTentang as $item)
                                                    <div class="col-4">
                                                        @if ($item->id_tentang == $data['id_tentang'])
                                                            <img src="{{ $item->file_gambar_tentang }}"
                                                                alt="{{ $data['judul_tentang'] }}"
                                                                style="all: initial; width:100%;">
                                                        @endif
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12">
                                                    <h2 class="text-center">{{ $data['judul_tentang'] }}</h2>
                                                    <p class="text-justify">{{ $data['deskripsi_judul_tentang'] }}</p>
                                                    <p class="text-justify">{{ $data['deskripsi_tentang'] }}</p>
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
                            <a href="{{ route('tentang.edit', [$data['id_tentang'], $data['id_gambar_tentang']]) }}"
                                class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('tentang.delete', [$data['id_tentang'], $data['id_gambar_tentang']]) }}"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
